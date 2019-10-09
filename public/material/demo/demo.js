demo = {
  initDocumentationCharts: function() {
    if ($('#dailySalesChart').length != 0 && $('#websiteViewsChart').length != 0) {
      /* ----------========== Users Sessions Chart initialization  ==========---------- */

      dataDailySalesChart = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [12, 17, 7, 17, 23, 18, 38]
        ]
      };

      optionsDailySalesChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 50,
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
      }

      var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

      var animationHeaderChart = new Chartist.Line('#websiteViewsChart', dataDailySalesChart, optionsDailySalesChart);
    }
  },

  initDashboardPageCharts: function() {

    if ($('#dailySalesChart').length != 0 || $('#completedTasksChart').length != 0 || $('#websiteViewsChart').length != 0) {
      /* ----------========== Users Sessions Chart initialization  ==========---------- */

      // first chart
      // TODO : get data users sessions;

      dataDailySalesChart = {
        labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
        series: [
          [12, 17, 7, 17, 23, 18, 38]
        ]
      };

      optionsDailySalesChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 50,
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        },
      }

      var dailySalesChart = new Chartist.Line('#dailySalesChart', dataDailySalesChart, optionsDailySalesChart);

      // start animation for the Users Sessions Chart - Line Chart
      md.startAnimationForLineChart(dailySalesChart);



      /* ----------==========     Completed Tasks Chart initialization    ==========---------- */

      dataCompletedTasksChart = {
        labels: ['12p', '3p', '6p', '9p', '12p', '3a', '6a', '9a'],
        series: [
          [230, 750, 450, 300, 280, 240, 200, 190]
        ]
      };

      optionsCompletedTasksChart = {
        lineSmooth: Chartist.Interpolation.cardinal({
          tension: 0
        }),
        low: 0,
        high: 1000,
        chartPadding: {
          top: 0,
          right: 0,
          bottom: 0,
          left: 0
        }
      }

      var completedTasksChart = new Chartist.Line('#completedTasksChart', dataCompletedTasksChart, optionsCompletedTasksChart);

      // start animation for the Completed Tasks Chart - Line Chart
      md.startAnimationForLineChart(completedTasksChart);


      /* ----------========== Users Inscriptions Chart initialization    ==========---------- */

      // second chart
      // get users inscriptions data
      var dataWebsiteViewsChart = {
        labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
        series: [
          [542, 443, 320, 780, 553, 453, 326, 434, 568, 610, 756, 895]

        ]
      };
      var optionsWebsiteViewsChart = {
        axisX: {
          showGrid: false
        },
        low: 0,
        high: 1000,
        chartPadding: {
          top: 0,
          right: 5,
          bottom: 0,
          left: 0
        }
      };
      var responsiveOptions = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function(value) {
              return value[0];
            }
          }
        }]
      ];
      var websiteViewsChart = Chartist.Bar('#websiteViewsChart', dataWebsiteViewsChart, optionsWebsiteViewsChart, responsiveOptions);
      //start animation for the users inscriptions Chart
      md.startAnimationForBarChart(websiteViewsChart);
    }
  },

  initGoogleMaps: function()
  {
    //map
    var map = L.map('map').setView([34.7405600,10.7602800],10);
    // OpenStreetMap
    var osmLayer = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors',
        minZoom:1,
        maxZoom: 5
    });
    // Wikimedia
    var mainLayer = L.tileLayer('https://maps.wikimedia.org/osm-intl/{z}/{x}/{y}{r}.png', {
        attribution: '<a href="https://wikimediafoundation.org/wiki/Maps_Terms_of_Use">Wikimedia</a>',
        minZoom: 1,
        maxZoom: 5
    });
     // positron layer
     var positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png', {
		      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, &copy; <a href="https://carto.com/attribution">CARTO</a>',
          minZoom: 1,
          maxZoom:5,
        });
    // control layer
    var controlLayer = L.control.layers({
        'OpenStreetMap': osmLayer,
        'Wikimedia': mainLayer,
        'positron':positron
      });
    // locate button
    L.easyButton('fa-crosshairs fa-lg', function(btn, map){
    map.locate({setView: true, maxZoom: 18});
    }).addTo(map);
    //add layers
      mainLayer.addTo(map);
      controlLayer.addTo(map);
    // find location
       map.on('locationfound', function (event) {
        console.log(event);
        L.circle(event.latlng, event.accuracy).addTo(map);
        var marker = L.marker(event.latlng).addTo(map);
        // var msg = L.popup().
        //     setContent("Your Location").
        //     setLatLng(event.latlng).addTo(map);
       });
     // Initialise the FeatureGroup to store editable layers
     var drawnItems = new L.FeatureGroup();
     map.addLayer(drawnItems);
     // Initialise the draw control and pass it the FeatureGroup of editable layers
    var drawControl = new L.Control.Draw({
      edit: {
        featureGroup: drawnItems
      }
    });
    map.addControl(drawControl);
    map.on(L.Draw.Event.CREATED, function (e) {
      var type = e.layerType
      var layer = e.layer;
      //check type
      if(type =='circle')
      {
        // set zone
        $('input[id="lat"]').val(layer._latlng.lat * 2);
        $('input[id="lng"]').val(layer._latlng.lng * 2);
        //console.log(layer);
        //var test =L.marker(layer._renderer._map._animateToCenter).addTo(map);
        //console.log(layer);
        //draw layer
        drawnItems.addLayer(layer);
      }
    });

    // fetch clients data
    $.get('/api/clients',function(data)
      {
      var markers = L.markerClusterGroup();
      //console.log(data);
      for(var i =0; i<data.length;i++)
      {
        var marker =L.marker([data[i].lat,data[i].lng])
                      .bindPopup('<span style="color:red">'+data[i].name +'</span><br/>'+ data[i].email);
            markers.addLayer(marker);
      }
      // add cluster group
      map.addLayer(markers);
      }
    );
          //set circle
          // map.on('click', placerMarqueur);
          // function placerMarqueur(e)
          //   {
          //     var circle = L.circle([e.latlng.lat,e.latlng.lng],1000).addTo(map);
          //     //console.log(e);
          //     //drag and drop circle;
          //     circle.on({
          //         mousedown: function () {map.on('mousemove', function(e) {circle.setLatLng(e.latlng);});},
          //         click: function () {map.removeEventListener();}});
          // }
  }
}
