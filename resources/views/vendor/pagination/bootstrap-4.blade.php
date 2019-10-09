@if ($paginator->hasPages())
<div class="row justify-content-center">
  <div class="card">
      <div class=" card-body col-md-3">
        <ul class="pagination" role="navigation" style="margin:auto;">
          {{-- Previous Page Link --}}
          @if ($paginator->onFirstPage())
          <li class="page-item disabled">
            <a class="page-link disabled" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          @else
          <li class="page-item">
            <a class="page-link" href="{{$paginator->previousPageUrl()}}" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          @endif
          <!-- elements -->
          {{-- Pagination Elements --}}
          @foreach ($elements as $element)
              {{-- "Three Dots" Separator --}}
              @if (is_string($element))
              <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
              @endif
              {{-- Array Of Links --}}
              @if (is_array($element))
                  @foreach ($element as $page => $url)
                      @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                      @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                      @endif
                    @endforeach
                  @endif
              @endforeach
          {{-- Next Page Link --}}
          @if ($paginator->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{$paginator->nextPageUrl()}}" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
          @else
          <li class="page-item disabled">
            <a class="page-link disabled" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
          @endif
        </ul>
    </div>
</div>
</div>
@endif
