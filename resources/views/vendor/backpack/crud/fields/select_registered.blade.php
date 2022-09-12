<!-- select from array -->
@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')
    <select
        name="{{ $field['name'] }}@if (isset($field['allows_multiple']) && $field['allows_multiple']==true)[]@endif"
        @include('crud::fields.inc.attributes')
        @if (isset($field['allows_multiple']) && $field['allows_multiple']==true)multiple @endif
        >

        @if (isset($field['allows_null']) && $field['allows_null']==true)
            <option value="">-</option>
        @endif

        @if (count($field['options']))
            @foreach ($field['options'] as $key => $value)
                @if((old(square_brackets_to_dots($field['name'])) && (
                        $key == old(square_brackets_to_dots($field['name'])) ||
                        (is_array(old(square_brackets_to_dots($field['name']))) &&
                        in_array($key, old(square_brackets_to_dots($field['name'])))))) ||
                        (null === old(square_brackets_to_dots($field['name'])) &&
                            ((isset($field['value']) && (
                                        $key == $field['value'] || (
                                                is_array($field['value']) &&
                                                in_array($key, $field['value'])
                                                )
                                        )) ||
                                (isset($field['default']) &&
                                ($key == $field['default'] || (
                                                is_array($field['default']) &&
                                                in_array($key, $field['default'])
                                            )
                                        )
                                ))
                        ))
                    <option value="{{ $key }}" selected>{{ $value }}</option>
                @else
                    <option value="{{ $key }}">{{ $value }}</option>
                @endif
            @endforeach
        @endif
    </select>

    {{-- HINT --}}
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
@include('crud::fields.inc.wrapper_end')

@push('crud_fields_scripts')
<!-- no scripts -->
<script>
    var old = {{old('registered')}}
    console.log({{old('registered')}}); // DO NOT REMOVE
    $( document ).ready(function() {
        // Check if Registered has Old Value
        if(old == 0){
            $('select[name="registered"').val('0'); 
            $('select[name="business_id"').parent().hide();
            $('select[name="business_id"').val('');

            // Fields if Business Not Registered
            $('input[name="company_name"').parent().show();
            $('input[name="contact_person"').parent().show();
            $('input[name="contact_number"').parent().show();
        }else if(old == 1){
            $('select[name="registered"').val('1');
            $('input[name="company_name"').parent().hide();
            $('input[name="contact_person"').parent().hide();
            $('input[name="contact_number"').parent().hide();
            $('input[name="company_name"').val('');
            $('input[name="contact_person"').val('');
            $('input[name="contact_number"').val('');
        }
        else if($('select[name="registered"').val() == 1){
            $('select[name="registered"').val('1');
            $('input[name="company_name"').parent().hide();
            $('input[name="contact_person"').parent().hide();
            $('input[name="contact_number"').parent().hide();
            $('input[name="company_name"').val('');
            $('input[name="contact_person"').val('');
            $('input[name="contact_number"').val('');
        }
        else if($('select[name="registered"').val() == 0){
            $('select[name="registered"').val('0'); 
            $('select[name="business_id"').parent().hide();
            $('select[name="business_id"').val('');

            // Fields if Business Not Registered
            $('input[name="company_name"').parent().show();
            $('input[name="contact_person"').parent().show();
            $('input[name="contact_number"').parent().show();
        }
    
    });
    $('select[name="registered"').on('change', function() {
        // Check if Business is Registered in One Papanga
        if ($('select[name="registered"').find(":selected").val() == '1'){
            $('select[name="registered"').val('1');
            $('select[name="business_id"').parent().show();

            // Fields if Business Not Registered
            $('input[name="company_name"').parent().hide();
            $('input[name="contact_person"').parent().hide();
            $('input[name="contact_number"').parent().hide();

            $('input[name="company_name"').val('');
            $('input[name="contact_person"').val('');
            $('input[name="contact_number"').val('');
        } else {
            $('select[name="registered"').val('0');
            $('select[name="business_id"').parent().hide();
            $('select[name="business_id"').val('');

             // Fields if Business Not Registered
            $('input[name="company_name"').parent().show();
            $('input[name="contact_person"').parent().show();
            $('input[name="contact_number"').parent().show();
        }
    });
</script>
@endpush
