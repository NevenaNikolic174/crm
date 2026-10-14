    <div class="modal fade" id="legendModal_brFakture" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Legenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p class="mb-2">
                                <b>
                                    <span style="background-color: yellow; color: black; font-weight: bold; padding: 2px 6px; border-radius: 50%; font-size: 12px;">D</span>
                                </b> 
                                - Dokument sa ovom oznakom je zaveden u neku od Knjiga dokumenta.
                            </p>	
                            <p class="mb-2">
                                <b>
                                    <i class="la la-truck" style="font-size: 16px; color: #3565ec;"></i>
                                </b>
                                - Za otpremnicu sa ovom oznakom je evidentiran početak vožnje.
                            </p>
				
                            {{-- samo na listama otpremnica --}}
                            <p class="mb-2" data-legend="despatch">
                                <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b8ff0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg></b>
                                - Otpremnica je automatski stornirana od strane SEO, jer nije došlo do fizičkog prijema u zakonskom roku od 30 dana od otpočinjanja kretanja dobara.
                            </p>
                            {{-- samo na listama prijemnica --}}
                            <p class="mb-2" data-legend="receipt">
                                <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b8ff0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"></path><path d="M20 3v4"></path><path d="M22 5h-4"></path><path d="M4 17v2"></path><path d="M5 18H3"></path></svg></b>
                                - Prijemnicu je automatski kreirao SEO, jer nije kreirana u roku od 8 dana od fizičkog prijema robe. Broj je sledeći sa brojača, a ako brojač nije uključen, broj otpremnice sa prefiksom „p".
                            </p>
                            <p class="mb-2" data-legend="receipt">
                                <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#3b8ff0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg></b>
                                - Prijemnica je automatski odbijena od strane SEO, jer nije prihvaćena u roku od 30 dana.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Zatvori</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openInfoModal_brFakture(e) {
            if (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                e.stopPropagation();
            }

            // redovi o automatskim radnjama zavise od toga da li smo na listi prijemnica ili otpremnica
            var legendType = window.location.pathname.indexOf('/receiptAdvice') === 0 ? 'receipt' : 'despatch';
            $('#legendModal_brFakture [data-legend]').each(function () {
                $(this).toggle($(this).data('legend') === legendType);
            });

            $('#legendModal_brFakture').modal('show');
        }
    </script>
