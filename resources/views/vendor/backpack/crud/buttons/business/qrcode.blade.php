@if ($crud->hasAccess('qrcode'))
    {{-- <a href="javascript:void(0)" class="btn btn-sm btn-link"
        data-toggle="modal" data-target="#qrModal{{$entry->getKey()}}"
        data-id="{{ $entry->getKey() }}" data-slug="{{ $entry->business->slug }}"
        data-route="{{ url($crud->route.'/'.$entry->getKey().'/qr-code') }}">
        <i class="la la-qrcode"></i> QR Code
    </a> --}}

    {{-- @push('after_scripts') @if (request()->ajax()) @endpush @endif
        <!-- Modal -->
        <div class="modal fade" id="qrModal{{$entry->getKey()}}" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel{{$entry->getKey()}}" aria-modal="true" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="qrModalLabel{{$entry->getKey()}}">{{ $entry->business->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        @if($entry->business)
                            {!! \QrCode::size(150)->generate(url($entry->business->slug . '/online-payment')) !!}
                        @else
                        @endif
                        <br>
                        <h5> Online Payment QR </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Download</button>
                    </div>
                </div>
            </div>
        </div>
        
    @if (!request()->ajax()) @endpush @endif --}}

    <a href="javascript:void(0)" onclick="qrCode(this)" class="btn btn-sm btn-link" data-id="{{$entry->getKey()}}"
    data-route="{{ url($crud->route.'/'.$entry->getKey().'/qr-code') }}" data-button-type="qrCode">
        <i class="la la-qrcode"></i> QR Code
    </a>

    @push('after_scripts') @if (request()->ajax()) @endpush @endif
        <script>
            if (typeof v != 'function') {
                $("[data-button-type=qrCode]").unbind('click');

                function qrCode(button) {
                    // ask for confirmation before deleting an item
                    // e.preventDefault();
                    var button  = $(button);
                    var id      = button.attr('data-id');
                    var route   = button.attr('data-route');

                    console.log(route);

                    $.ajax({
                        url: '/' + '{{$crud->route}}' + '/api/' + id + '/qr-code',
                        data: {

                        },
                        success: function(result) {
                            if(result.status === 'success') {
                                swal({
                                    text: "Loading...",
                                    // icon: "warning",
                                    buttons: {
                                        cancel: {
                                            text: "Close",
                                            value: null,
                                            visible: true,
                                            className: "bg-secondary",
                                            closeModal: true,
                                        },
                                        submit: {
                                            text: "Download",
                                            value: true,
                                            visible: true,
                                            className: "bg-primary",
                                        }
                                    },
                                }).then((value) => {
                                    if (value) {
                                        window.location.href = route;
                                    }
                                });
                                $('.swal-text').html(result.data);
                            }
                            else {
                                swal({
                                    title: "QR Error",
                                    text: "Something went wrong, please reload the page.",
                                    icon: "error",
                                    timer: 4000,
                                    buttons: false,
                                });
                            }

			            },
			            error: function(result) {
			            // Show an alert with the result
			                swal({
                                title: "QR Error",
                                text: "Something went wrong, please reload the page.",
                                icon: "error",
                                timer: 4000,
                                buttons: false,
		                    });
			            }
			        });

                }
            }

        </script>
    @if (!request()->ajax()) @endpush @endif
@endif