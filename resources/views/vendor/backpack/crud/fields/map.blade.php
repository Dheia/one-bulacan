<!-- text input -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    @if(isset($field['prefix']) || isset($field['suffix'])) <div class="input-group"> @endif
        @if(isset($field['prefix'])) <div class="input-group-prepend"><span class="input-group-text">{!! $field['prefix'] !!}</span></div> @endif
        <div id="map" name="map" style="width: 500px; height:500px;" @include('crud::fields.inc.attributes')></div>
        @if(isset($field['suffix'])) <div class="input-group-append"><span class="input-group-text">{!! $field['suffix'] !!}</span></div> @endif
    @if(isset($field['prefix']) || isset($field['suffix'])) </div> @endif

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')


@push('crud_fields_scripts')
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVBcx1Fi-u32Cec-QaXpaPL7NTt3G6HHQ&map_ids=8f49a54f3d37eefa&callback=initMap&libraries=&v=weekly" async></script>

  <script>
    var latLong;
    var latitude;
    var longitude;
    let marker;

    @if($crud->getActionMethod() == 'create')
      latitude  = {{ old('latitude') ? old('latitude') : 0 }};
      longitude = {{ old('longitude') ? old('longitude') : 0 }};
    @endif

    @if($crud->getActionMethod() == 'edit')
      latitude  = {{ $crud->entry->latitude ? $crud->entry->latitude : 0 }};
      longitude = {{ $crud->entry->longitude ? $crud->entry->longitude : 0 }};
    @endif

    function initMap()
    {
      console.log({{Config('settings.latitude')}}, {{Config('settings.longitude')}});
      const myLatlng = { lat: latitude ? latitude : {{Config('settings.latitude')}}, lng: longitude ? longitude : {{Config('settings.longitude')}} };
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 9,
        center: myLatlng,
        mapId: '8f49a54f3d37eefa',
      });

      // Create / Show Marker
      marker = new google.maps.Marker({
        map,
        draggable: false,
        animation: google.maps.Animation.DROP,
        position: myLatlng,
      });

      // Create the initial InfoWindow.
      let infoWindow = new google.maps.InfoWindow({
        content: "Set your business location by gradding and clicking the map.",
        position: myLatlng,
      });
      infoWindow.open(map);

      // Configure the click listener.
      map.addListener("click", (mapsMouseEvent) => {
        // Close the current InfoWindow.
        infoWindow.close();
        // Create a new InfoWindow.
        infoWindow = new google.maps.InfoWindow({
          position: mapsMouseEvent.latLng,
        });
        infoWindow.setContent(
          JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        );
        infoWindow.open(map);

        latLong   = JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
        latitude  = JSON.parse(latLong)["lat"]
        longitude = JSON.parse(latLong)["lng"]

        // Change Marker Position
        marker.setPosition(mapsMouseEvent.latLng);
        markerToggleBounce();

        $('input[name=latitude]').val(latitude);
        $('input[name=longitude]').val(longitude);
      });

    }

    function markerToggleBounce()
    {
      marker.setAnimation(google.maps.Animation.BOUNCE);
      // if (marker.getAnimation() !== null) {
      //   marker.setAnimation(null);
      // } else {
      //   marker.setAnimation(google.maps.Animation.BOUNCE);
      // }
    }
  </script>
@endpush