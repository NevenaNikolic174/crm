//lokalizacija za tinymce
var tinymceLoc;
function localeTinymce() {
    tinymceLoc = $('html').attr('lang');
}

localeTinymce();

$(window).on('load', function() {
    $('.app-loader-div').fadeOut(120);
    $('.m-grid--root').css('overflow-y', 'auto');
    $('body').css('overflow-y', 'auto');

    $('.modal').bind('hidden.bs.modal', function(e) {
        return false;
    });
    let employeeID = $('#loggedUser').val();
    let activeModule = $('#moduleActive').val();
    if (employeeID && activeModule == 'Kadrovik') {
        $.ajax({
            type: 'GET',
            url: '/kadrovik/get/urucena/dokumenta/' + employeeID,
        }).done(function(response) {
            response.forEach(absence => {
                let html = `<a href="#" onclick="openUrucenDokumentModalGlobal(${absence.id} , ${absence.createdFromKancelarko})"  style="font-size: 20px" >
                        Link do dokumenta
                    </a> <br><br>`;
                $('#absenceId').val(absence.id);
                document.getElementById('link').innerHTML = html;

                html = `Za zaposlenog <strong> ${absence.firstname} ${absence.lastname} </strong>  je odobreno/evidentirano korišćenje odsustva  `;
                document.getElementById('izjava').innerHTML = html;
                $('#procitanoResenje').modal({ backdrop: 'static', keyboard: false });
            });
        });

        $.ajax({
            type: 'GET',
            url: '/kadrovik/get/ponistena/resenja/' + employeeID,
        }).done(function(response) {
            response.forEach(absence => {
                let html = `<a href="#" onclick=" openPonistenDokumentModalGlobal(${absence.id},  ${absence.createdFromKancelarko} )"  style="font-size: 20px" >
                        Link do dokumenta
                    </a> <br><br>`;
                $('#absenceId').val(absence.id);
                document.getElementById('linkFall').innerHTML = html;

                html = `Za zaposlenog <strong> ${absence.firstname} ${absence.lastname} </strong> je poništeno rešenje o korišćenju  odsustva  u periodu <strong> od   ${moment(
                    absence.date_from,
                ).format('DD.MM.YYYY')} do ${moment(absence.date_until).format('DD.MM.YYYY')}. </strong>`;
                document.getElementById('izjavaFall').innerHTML = html;
                $('#ponistenoResenje').modal({ backdrop: 'static', keyboard: false });
            });
        });

        $.ajax({
            type: 'GET',
            url: '/kadrovik/get/editovana/resenja/' + employeeID,
        }).done(function(response) {
            response.forEach(absence => {
                let html = ``;
                $('#absenceId').val(absence.id);
                document.getElementById('linkEdit').innerHTML = html;

                html = `Za zaposlenog <strong> ${absence.firstname} ${absence.lastname} </strong> je izmenjen period korišćenja  odsustva  u periodu <strong> od   ${moment(
                    absence.date_from,
                ).format('DD.MM.YYYY')} do ${moment(absence.date_until).format('DD.MM.YYYY')}. </strong>`;
                document.getElementById('izjavaEdit').innerHTML = html;
                $('#editResenje').modal({ backdrop: 'static', keyboard: false });
            });
        });
    }
});


$('#podaciOLicenci').on('shown.bs.modal', function() {
    axios.get('/getStatusOfTimestamps').then(data => {
        const ukupnoKredita = data.data.totalCredits;
        const istrosenoKredita = data.data.usedCredits;
        const preostaloKredita = data.data.remainingCredits;

        $('#ukupnoKredita').html(ukupnoKredita);
        $('#istrosenoKredita').html(istrosenoKredita);
        $('#preostaloKredita').html(preostaloKredita);
    });
});

$("#openKorisnickaModal").click(function (){
    $("#podrska").modal("show");
});
$('#buttonPotvrdi').click(function() {
    if ($('#potvrda').is(':checked')) {
        $.ajax({
            type: 'POST',
            url: '/kadrovik/procitana/urucena/dokumenta',
            data: { absenceId: $('#absenceId').val() },
        }).done(function(response) {
            if (response) {
                $('#procitanoResenje').modal('hide');

                swal({
                    title: '',
                    text: 'Hvala što ste potvrdili prijem.',
                    type: 'success',
                    timer: 2000,
                });
            }
        });
    }
});

$('#buttonPotvrdiFall').click(function() {
    if ($('#potvrdaFall').is(':checked')) {
        $.ajax({
            type: 'POST',
            url: '/kadrovik/procitana/ponistena/dokumenta',
            data: { absenceId: $('#absenceId').val() },
        }).done(function(response) {
            if (response) {
                $('#ponistenoResenje').modal('hide');

                swal({
                    title: '',
                    text: 'Hvala što ste potvrdili prijem.',
                    type: 'success',
                    timer: 2000,
                });
            }
        });
    }
});

$('#buttonPotvrdiEdit').click(function() {
    if ($('#potvrdaEdit').is(':checked')) {
        $.ajax({
            type: 'POST',
            url: '/kadrovik/procitana/editovana/dokumenta',
            data: { absenceId: $('#absenceId').val() },
        }).done(function(response) {
            if (response) {
                $('#editResenje').modal('hide');

                swal({
                    title: '',
                    text: 'Hvala što ste potvrdili.',
                    type: 'success',
                    timer: 2000,
                });
            }
        });
    }
});

function openUrucenDokumentModalGlobal(doc_id, created_from_kancelarko = null) {
    if (created_from_kancelarko == 1) {
        swal({
            title: '',
            text:
                'U skladu sa Zakonom o državnim i drugim praznicima u Republici Srbiji, zaposleni ima pravo da odustvuje sa rada na dane državnih i verskih praznika koji se praznuju neradno kao i na dane praznika koji mu pripadaju prema veroispovest',
            type: 'info',
            confirmButtonClass: 'btn btn-secondary m-btn m-btn--wide',
        });
    } else {
        populateUrucenoDocsHtmlGlobal(doc_id);
        $('#uruceniDokumentiSvi').modal();
    }
}
function openPonistenDokumentModalGlobal(doc_id, created_from_kancelarko = null) {
    if (created_from_kancelarko == 1) {
        swal({
            title: '',
            text:
                'U skladu sa Zakonom o državnim i drugim praznicima u Republici Srbiji, zaposleni ima pravo da odustvuje sa rada na dane državnih i verskih praznika koji se praznuju neradno kao i na dane praznika koji mu pripadaju prema veroispovest',
            type: 'info',
            confirmButtonClass: 'btn btn-secondary m-btn m-btn--wide',
        });
    } else {
        populatePonisteniDocsHtmlGlobal(doc_id);
        $('#ponistenaDokumentiSvi').modal();
    }
}

// dohvatamo potpisane dokumente ako postoje i ubacujemo ih u dom
function populateUrucenoDocsHtmlGlobal(doc_id) {
    $.ajax({
        method: 'get',
        url: '/kadrovik/listaResenja/dohvatanjeDokumentPrekoAbsenceId/' + doc_id,
    }).done(response => {
        if (response) {
            let potpisaniDoc = 0;
            let nepotpisaniDoc = 0;
            let fileHTML = '';
            response.forEach(element => {
                if (element.is_signed == 1) {
                    fileHTML += `
                    <p>
                        Naziv:
                        <a href="#" onclick="showSignedDocumentGlobal(${element.ID})" >
                            ${element.fileName}
                        </a> &nbsp;
                         <a title="Preuzmi rešenje" onclick="donwloadFileFromModalPotpisaniDokumentiGlobal(${element.ID})"  href="#">

                        <i id="listaResenjaDownload" data-documentid="' . $item->document_id . '" class="fa fa-download">
                        </i></a> <span   id="isread_${element.ID}" class="isread_${element.ID}">`;

                    if (element.is_readed == '1') {
                        fileHTML += ` &nbsp; <i class="la la-check text-success"> </i>`;
                    } else {
                        fileHTML += `  &nbsp;  <i class="la la-close text-danger"> </i>`;
                    }
                    fileHTML += ` </span>  &nbsp;
                    </p>`;
                    potpisaniDoc++;
                }
            });

            if (potpisaniDoc == 0) {
                fileHTML += ` Trenutno nisu dostupna dokumenta za preuzimanje`;
            }

            allSignedDocumentsArray = [];
            doc_id = '';
            $('#allDocsSigned').empty();
            $('#allDocsSigned').append(fileHTML);
            $('#allDocsSigned').css('display', 'block');

            fileHTML = '';

            response.forEach(element => {
                if (element.is_signed == 0) {
                    fileHTML += `
                    <p>
                        Naziv:
                        <a href="#" onclick="showSignedDocumentGlobal(${element.ID})" >
                            ${element.fileName}
                        </a> &nbsp;
                         <a title="Preuzmi rešenje" onclick="donwloadFileFromModalPotpisaniDokumentiGlobal(${element.ID})"  href="#">

                        <i id="listaResenjaDownload" data-documentid="' . $item->document_id . '" class="fa fa-download">
                        </i></a> <span   id="isread_${element.ID}" class="isread_${element.ID}">`;

                    if (element.is_readed == '1') {
                        fileHTML += ` &nbsp; <i class="la la-check text-success"> </i>`;
                    } else {
                        fileHTML += `  &nbsp;  <i class="la la-close text-danger"> </i>`;
                    }
                    fileHTML += ` </span>  &nbsp;
                    </p>`;
                    nepotpisaniDoc++;
                }
            });
            if (nepotpisaniDoc == 0) {
                fileHTML += ` Trenutno nisu dostupna dokumenta za preuzimanje`;
            }
            allSignedDocumentsArray = [];
            doc_id = '';
            $('#allDocsNotSigned').empty();
            $('#allDocsNotSigned').append(fileHTML);
            $('#allDocsNotSigned').css('display', 'block');
        }
    });
}

function populatePonisteniDocsHtmlGlobal(doc_id) {
    $.ajax({
        method: 'get',
        url: '/kadrovik/listaResenja/dohvatanjeDokumentPrekoAbsenceIdPonisteni/' + doc_id,
    }).done(response => {
        if (response) {
            let delDoc = 0;
            let fileHTML = '';
            response.forEach(element => {
                fileHTML += `
                    <p>
                        Naziv:
                        <a href="#" onclick="showSignedDocumentGlobal(${element.ID})" >
                            ${element.fileName}
                        </a> &nbsp;
                         <a title="Preuzmi rešenje" onclick="donwloadFileFromModalPotpisaniDokumentiGlobal(${element.ID})"  href="#">

                        <i id="listaResenjaDownload" data-documentid="' . $item->document_id . '" class="fa fa-download">
                        </i></a> <span   id="isread_${element.ID}" class="isread_${element.ID}">`;

                if (element.is_readed == '1') {
                    fileHTML += ` &nbsp; <i class="la la-check text-success"> </i>`;
                } else {
                    fileHTML += `  &nbsp;  <i class="la la-close text-danger"> </i>`;
                }
                fileHTML += ` </span>  &nbsp;
                                </p>`;
                delDoc++;
            });
            if (delDoc == 0) {
                fileHTML += ` Trenutno nisu dostupna dokumenta za preuzimanje`;
            }
            allSignedDocumentsArray = [];
            doc_id = '';
            $('#allDocsfall').empty();
            $('#allDocsfall').append(fileHTML);
            $('#allDocsfall').css('display', 'block');
        }
    });
}

function showSignedDocumentGlobal(id) {
    axios
        .get('/kadrovik/listaResenja/downloadResnje/check/' + id)
        .then(response => {
            axios.get('/kadrovik/procitan-dokument/' + id).then(response => {
                window.open('/kadrovik/listaResenja/showSignedDocumentsCloud/' + id, '_blank');
                $('#isread_' + id).html(' <i class="la la-check text-success"> </i>');
            });
        })
        .catch(function(error) {
            // Obrada slučaja kada je status odgovora 404
            swal({
                title: '',
                text: 'Dokument ne postoji',
                type: 'error',
                confirmButtonClass: 'btn btn-secondary m-btn m-btn--wide',
            });
        });
}

function donwloadFileFromModalPotpisaniDokumentiGlobal(id) {
    axios
        .get('/kadrovik/listaResenja/downloadResnje/check/' + id)
        .then(response => {
            axios.get('/kadrovik/procitan-dokument/' + id).then(response => {
                window.location = '/kadrovik/listaResenja/downloadSignedDocs/' + id;
                $('#isread_' + id).html(' <i class="la la-check text-success"> </i>');
            });
        })
        .catch(function(error) {
            // Obrada slučaja kada je status odgovora 404
            swal({
                title: '',
                text: 'Dokument ne postoji',
                type: 'error',
                confirmButtonClass: 'btn btn-secondary m-btn m-btn--wide',
            });
        });
}

function checkAddColumns() {
    var columns = $('.addColumnTrigger');
    columns.each((index, item) => {
        var column = $(item).attr('column');
        if (localStorage.getItem('SDEAddCollumn.' + column)) {
            $('#' + column).prop('checked', true);
        }
    });
}

function checkAddColumnsR() {
    var columns = $('.addColumnTrigger');
    columns.each((index, item) => {
        var column = $(item).attr('column');
        if (localStorage.getItem('SDEAddCollumnR.' + column)) {
            $('#' + column).prop('checked', true);
        }
    });
}

function pagingNumber(list, checkboxName = 'savePaging') {
    $('#' + checkboxName).prop('checked', false);
    var pagingNumber = localStorage.getItem(list);
    if (pagingNumber != null && pagingNumber != 'false' && pagingNumber != 'null') {
        $('#' + checkboxName).prop('checked', true);
    }
}

function savePagingNumber(list, value) {
    localStorage.setItem(list, value);

    if ($('#showMassSelect').length && value) {
        const showMassSelectval = $('#showMassSelect').is(':checked');
        localStorage.setItem(`${list}_showMassSelect`, showMassSelectval);
    } else {
        localStorage.setItem(`${list}_showMassSelect`, false);
    }
}

function getPagingNumber(list, checkboxName = 'savePaging') {
    if ($('#' + checkboxName).is(':checked')) {
        var pagingNumber = localStorage.getItem(list);
        if (pagingNumber != 'false' && pagingNumber != null && pagingNumber != 'null') {
            return Number(pagingNumber);
        } else {
            return 10;
        }
    } else {
        return 10;
    }
}

// trenutno se ne koristi
function loaderInit() {
    /* Optimizacija - za stranice koje nemaju loader */
    if (loaderExceptions()) {
        $('.m-grid--root').css('overflow-y', 'auto');
        $('.app-loader-div').remove();
    } else {
        $('.m-grid--root').css('overflow-y', 'hidden');
    }
}

/* vraca true ako se deo uri-ja nalazi u nizu. Tada na toj stranici nece biti ucitan loader i .m-grid--root ce imati overflow-y: auto (imace odmah scroll) */
function loaderExceptions() {
    let paths = ['/document/viewDocument'];
    let contains = false;
    paths.forEach((path, index) => {
        if (window.location.pathname.indexOf(path) != -1) {
            contains = true;
        }
    });
    return contains;
}

loaderInit();

/* modali ukloni sadrzaj */
function pageReload() {
    var currentURL = window.location.href;
    var urlLength = currentURL.length;
    var getLastChar = currentURL.charAt(urlLength - 1);

    if (getLastChar == '#') {
        currentURL = currentURL.replace('#', '');
    }

    window.location.replace(currentURL);
}

/**
 *
 * @param {string} elementId | Button selector id (without '#')
 * @param {boolean} toggle | TRUE for disabling; FALSE for enabling; Default is TRUE
 * @returns void
 * Postavlja ili skida loader i disabled atribut sa dugmeta.
 */
function toggleLoader(elementId, toggle = true) {
    if (toggle)
        $('#' + elementId)
            .prop('disabled', true)
            .addClass('m-loader m-loader--light m-loader--right');
    else
        $('#' + elementId)
            .prop('disabled', false)
            .removeClass('m-loader m-loader--light m-loader--right');
}

/**
 *
 * @param {string} formId | Form selector id (without '#')
 * @param {boolean} toggle | TRUE for disabling; FALSE for enabling; Default is TRUE
 * @returns void
 * Postavlja ili skida loader i disabled atribut sa submit dugmeta forme
 */
function toggleLoaderForm(formId, toggle = true) {
    if (toggle) {
        $('#' + formId)
            .find('input[type="submit"]')
            .first()
            .prop('disabled', true)
            .addClass('m-loader m-loader--light m-loader--right');
        $('#' + formId)
            .find('button[type="submit"]')
            .first()
            .prop('disabled', true)
            .addClass('m-loader m-loader--light m-loader--right');
    } else {
        $('#' + formId)
            .find('input[type="submit"]')
            .first()
            .prop('disabled', false)
            .removeClass('m-loader m-loader--light m-loader--right');
        $('#' + formId)
            .find('button[type="submit"]')
            .first()
            .prop('disabled', false)
            .removeClass('m-loader m-loader--light m-loader--right');
    }
}

/**
 *
 * @param {string} email
 * @param {Function} response
 *
 * Poziva se u situaciji kada se šalju emailovi radi provere da li je moguće slanje na određeni email.
 * Koristi se npr. na sledeći način:
 * canBeSendedOn('test@paragraf.rs', response => {
 *    // PA OVDE IDE DA LI SE ZABRANJUJE SLANJE ILI SE ISPISUJE UPOZORENJE ITD
 *    // response je string sa sledećim vrednostima: ALLOWED, FORBIDDEN, UNKNOWN (Detaljnije ima na serverskoj strani u EmailTrackingController.php,
 *    // metoda se zove canBeSendedOn)
 * });
 */
function canBeSendedOn(email, response) {
    $.get('/canBeSendedOn?email=' + email).then(response);
}

/**
 *
 * @param {string} buttonID | Button selector id (without '#')
 * @param {boolean} showDummy | TRUE for showing dummy button; FALSE for hiding dummy button; Default is TRUE
 * @returns {boolean}
 * Koristi se samo ukoliko ni toggleLoader ni toggleForm load iz nekog razloga ne mogu da se primene. Tada u formu dodati još jedno "dummy" dugme
 * <button class="btn btn-{success ili danger} pull-right m-loader m-loader--light m-loader--right" id="dummy_{idPravogDugmeta}" style="display: none;" disabled>{tekst}</button>
 *
 */
function switchButtons(buttonID, showDummy = true) {
    if (showDummy == true) {
        $('#' + buttonID).hide();
        $('#dummy_' + buttonID).show();
    } else {
        showDummy = false;
        $('#dummy_' + buttonID).hide();
        $('#' + buttonID).show();
    }
    return showDummy;
}

$.ajax({
    type: 'GET',
    url: '/checkFileServers',
}).done(function(response) {
    window.fileServer = response;
    localStorage.setItem('fileServer', response);
});

$('.modalRefreshContentCancel').on('click', function(e) {
    pageReload();
});

$('.modal.restoreModalPN').on('hidden.bs.modal', function() {
    $('#endDate').prop('disabled', false);
    $('#endTime').prop('disabled', false);
    $('#taskTypeList')
        .val(0)
        .trigger('chosen:updated');
    $('#documentPriority')
        .val(0)
        .trigger('chosen:updated');
    $('#typeOther2').prop('checked', true);
    $('#showInstitutionList2')
        .val(0)
        .trigger('chosen:updated');
    $('#showLocationList2')
        .val(0)
        .trigger('chosen:updated');

    $('#showInstitutionList_containter2').hide();
    $('#displayAllLocation2').hide();
    $('#location2').show();
});

$('.modal.restoreModalCaseObl').on('hidden.bs.modal', function() {
    $('#endDate').prop('disabled', false);
    $('#endTime').prop('disabled', false);
    $('#taskTypeList')
        .val(0)
        .trigger('chosen:updated');
    $('#typeOther').prop('checked', true);
    $('#showInstitutionList')
        .val(0)
        .trigger('chosen:updated');
    $('#showLocationList')
        .val(0)
        .trigger('chosen:updated');

    $('#showInstitutionList_containter').hide();
    $('#displayAllLocation').hide();
    $('#location22').show();
});

$('.modal.restorePrev.restoreValutaModal').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('currentValuta', $('#valutaPredmeta option:selected').val());
});

$('.modal.restorePrev.restoreValutaModal').on('hidden.bs.modal', function(e) {
    $('#valutaPredmeta').val(sessionStorage.getItem('currentValuta'));
    $('#valutaPredmeta').selectpicker('refresh');
});

$('.modal.restorePrev.restoreSubTypeModal').on('hidden.bs.modal', function(e) {
    $('#nadTipInsert').val('');
    $('#nadTipInsert').selectpicker('refresh');
});

// pdv - zaposleni

$('.modal.restorePrev.restoreModalPDV').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('currentPDV', $('#pdvStopa option:selected').val());
});

$('.modal.restorePrev.restoreModalPDV').on('hidden.bs.modal', function(e) {
    $('#pdvStopa')
        .val(sessionStorage.getItem('currentPDV'))
        .trigger('chosen:updated');
});

// sistem pdv - zaposleni

$('.modal.restorePrev.restoreSistemPDV').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('sistemPDV', $('#pdvSelect option:selected').val());
});

$('.modal.restorePrev.restoreSistemPDV').on('hidden.bs.modal', function(e) {
    $('#pdvSelect')
        .val(sessionStorage.getItem('sistemPDV'))
        .trigger('chosen:updated');
});

// broj racuna - zaposleni // single choosen

$('.modal.restorePrev.restoreAccNum').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('accNum', $('#accNum option:selected').val());
});

$('.modal.restorePrev.restoreAccNum').on('hidden.bs.modal', function(e) {
    $('#accNum')
        .val(sessionStorage.getItem('accNum'))
        .trigger('chosen:updated');
});

// lokali - zaposleni

$('.modal.restorePrev.restoreLocalModal').on('shown.bs.modal', function(e) {
    var localArr = $('#localSelect')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreLocal', localArr);
});

$('.modal.restorePrev.restoreLocalModal').on('hidden.bs.modal', function(e) {
    $('#localSelect')
        .val(sessionStorage.getItem('restoreLocal').split(','))
        .trigger('chosen:updated');
});

// jezici - zaposleni // multi choosen

$('.modal.restorePrev.restoreLanguageModal').on('shown.bs.modal', function(e) {
    var localArr2 = $('#languageSelect')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreLanguage', localArr2);
});

$('.modal.restorePrev.restoreLanguageModal').on('hidden.bs.modal', function(e) {
    $('#languageSelect')
        .val(sessionStorage.getItem('restoreLanguage').split(','))
        .trigger('chosen:updated');
});

// pol - zaposleni

$('.modal.restorePrev.restoreGenderModal').on('shown.bs.modal', function(e) {
    var localArr3 = $('#genderSelect')
        .chosen()
        .val();
    sessionStorage.setItem('restoreGender', localArr3);
});

$('.modal.restorePrev.restoreGenderModal').on('hidden.bs.modal', function(e) {
    $('#genderSelect')
        .val(sessionStorage.getItem('restoreGender'))
        .trigger('chosen:updated');
});

// datum rodjenja - zaposleni

$('.modal.restorePrev.restoreBirthModal').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreBirthDay', $('#birthDay option:selected').val());
    sessionStorage.setItem('restoreBirthMonth', $('#birthMonth option:selected').val());
    sessionStorage.setItem('restoreBirthYear', $('#birthYear option:selected').val());
});

$('.modal.restorePrev.restoreBirthModal').on('hidden.bs.modal', function(e) {
    $('#birthDay')
        .val(sessionStorage.getItem('restoreBirthDay'))
        .trigger('chosen:updated');
    $('#birthMonth')
        .val(sessionStorage.getItem('restoreBirthMonth'))
        .trigger('chosen:updated');
    $('#birthYear')
        .val(sessionStorage.getItem('restoreBirthYear'))
        .trigger('chosen:updated');
});

// vreme rodjenja - zaposleni

$('.modal.restorePrev.restoreBirthTime').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreBirthTimeHour', $('#birthTimeHour option:selected').val());
    sessionStorage.setItem('restoreBirthTimeMinute', $('#birthTimeMinute option:selected').val());
});

$('.modal.restorePrev.restoreBirthTime').on('hidden.bs.modal', function(e) {
    $('#birthTimeHour')
        .val(sessionStorage.getItem('restoreBirthTimeHour'))
        .trigger('chosen:updated');
    $('#birthTimeMinute')
        .val(sessionStorage.getItem('restoreBirthTimeMinute'))
        .trigger('chosen:updated');
});

// drzavljanstvo - zaposleni

$('.modal.restorePrev.restoreModalDrzavljanstvo').on('shown.bs.modal', function(e) {
    var localArr4 = $('#drzavljanstvo')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreDrzavljanstvo', localArr4);
});

$('.modal.restorePrev.restoreModalDrzavljanstvo').on('hidden.bs.modal', function(e) {
    $('#drzavljanstvo')
        .val(sessionStorage.getItem('restoreDrzavljanstvo').split(','))
        .trigger('chosen:updated');
});

// titula - zaposleni

$('.modal.restorePrev.restoreTitulaPrivateModal').on('shown.bs.modal', function(e) {
    var localArr5 = $('#titula')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreTitula', localArr5);
});

$('.modal.restorePrev.restoreTitulaPrivateModal').on('hidden.bs.modal', function(e) {
    $('#titula')
        .val(sessionStorage.getItem('restoreTitula').split(','))
        .trigger('chosen:updated');
});

// pol na rodjenju - zaposleni

$('.modal.restorePrev.restoreBirthModalGender').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreBirthGender', $('#genderBirth option:selected').val());
});

$('.modal.restorePrev.restoreBirthModalGender').on('hidden.bs.modal', function(e) {
    $('#genderBirth')
        .val(sessionStorage.getItem('restoreBirthGender'))
        .trigger('chosen:updated');
});

// krvna grupa - zaposleni

$('.modal.restorePrev.restoreBloodGroup').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreBloodGroup', $('#bloodGroup option:selected').val());
});

$('.modal.restorePrev.restoreBloodGroup').on('hidden.bs.modal', function(e) {
    $('#bloodGroup')
        .val(sessionStorage.getItem('restoreBloodGroup'))
        .trigger('chosen:updated');
});

// bracno stanje - zaposleni

$('.modal.restorePrev.restoreMarriageState').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreMarriageState', $('#marriageState option:selected').val());
});

$('.modal.restorePrev.restoreMarriageState').on('hidden.bs.modal', function(e) {
    $('#marriageState')
        .val(sessionStorage.getItem('restoreMarriageState'))
        .trigger('chosen:updated');
});

// strucna sprema - zaposleni

$('.modal.restorePrev.restoreProfessionalQual').on('shown.bs.modal', function(e) {
    var localArr6 = $('#profesionalQualification')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreProfessionalQual', localArr6);
});

$('.modal.restorePrev.restoreProfessionalQual').on('hidden.bs.modal', function(e) {
    $('#profesionalQualification')
        .val(sessionStorage.getItem('restoreProfessionalQual').split(','))
        .trigger('chosen:updated');
});

// vojni rok - zaposleni

$('.modal.restorePrev.restoreFormMilitary').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreFormMilitary', $('#military option:selected').val());
});

$('.modal.restorePrev.restoreFormMilitary').on('hidden.bs.modal', function(e) {
    $('#military')
        .val(sessionStorage.getItem('restoreFormMilitary'))
        .trigger('chosen:updated');
});

// veroispovest - zaposleni

$('.modal.restorePrev.restoreReligionModal').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreReligion', $('#religion option:selected').val());
});

$('.modal.restorePrev.restoreReligionModal').on('hidden.bs.modal', function(e) {
    $('#religion')
        .val(sessionStorage.getItem('restoreReligion'))
        .trigger('chosen:updated');
});

// slava - zaposleni

$('.modal.restorePrev.restoreReligionDay').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreReligionDay', $('#familyReligionDay option:selected').val());
});

$('.modal.restorePrev.restoreReligionDay').on('hidden.bs.modal', function(e) {
    $('#familyReligionDay')
        .val(sessionStorage.getItem('restoreReligionDay'))
        .trigger('chosen:updated');
});

// kancelarija - pdv

$('.modal.restorePrev.restoreOfficePDVModal').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreOfficePDV', $('#pdv option:selected').val());
});

$('.modal.restorePrev.restoreOfficePDVModal').on('hidden.bs.modal', function(e) {
    $('#pdv')
        .val(sessionStorage.getItem('restoreOfficePDV'))
        .trigger('chosen:updated');
});

// kancelarija - velicina

$('.modal.restorePrev.restoreOfficeSize').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreOfficeSize', $('#companySize option:selected').val());
});

$('.modal.restorePrev.restoreOfficeSize').on('hidden.bs.modal', function(e) {
    $('#companySize')
        .val(sessionStorage.getItem('restoreOfficeSize'))
        .trigger('chosen:updated');
});

// kancelarija - broj racuna

$('.modal.restorePrev.restoreAccNumOffice').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreAccNumOffice', $('#accNum option:selected').val());
});

$('.modal.restorePrev.restoreAccNumOffice').on('hidden.bs.modal', function(e) {
    $('#accNum')
        .val(sessionStorage.getItem('restoreAccNumOffice'))
        .trigger('chosen:updated');
});

// kancelarija - pdv izmena

$('.modal.restorePrev.restoreOfficePDVModal2').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreOfficePDV2', $('#pdvSelect option:selected').val());
});

$('.modal.restorePrev.restoreOfficePDVModal2').on('hidden.bs.modal', function(e) {
    $('#pdvSelect')
        .val(sessionStorage.getItem('restoreOfficePDV2'))
        .trigger('chosen:updated');
});

// kancelarija - pdv podrazumevana vrednost

$('.modal.restorePrev.restoreStopaModalPDV').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreStopaModalPDV', $('#pdvStopa option:selected').val());
});

$('.modal.restorePrev.restoreStopaModalPDV').on('hidden.bs.modal', function(e) {
    $('#pdvStopa')
        .val(sessionStorage.getItem('restoreStopaModalPDV'))
        .trigger('chosen:updated');
});

//parnterPreview -  veza sa drugim kontaktima

$('.modal.restorePrev.restoreRelationPartner').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreRelationPartner', $('#fizickoPravnoSelect option:selected').val());
});

$('.modal.restorePrev.restoreRelationPartner').on('hidden.bs.modal', function(e) {
    $('#fizickoPravnoSelect')
        .val(sessionStorage.getItem('restoreRelationPartner'))
        .trigger('chosen:updated');
});

//parnterPreview - pdv

$('.modal.restorePrev.restorePartnerPDV').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restorePartnerPDV', $('#pdv option:selected').val());
});

$('.modal.restorePrev.restorePartnerPDV').on('hidden.bs.modal', function(e) {
    $('#pdv')
        .val(sessionStorage.getItem('restorePartnerPDV'))
        .trigger('chosen:updated');
});

//parnterPreview - oblik organizovanja

$('.modal.restorePrev.restoreOrgTypePartner').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreOrgTypePartner', $('#orgType option:selected').val());
});

$('.modal.restorePrev.restoreOrgTypePartner').on('hidden.bs.modal', function(e) {
    $('#orgType')
        .val(sessionStorage.getItem('restoreOrgTypePartner'))
        .trigger('chosen:updated');
});

//parnterPreview - velicina

$('.modal.restorePrev.restoreSizePartner').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreSizePartner', $('#companySize option:selected').val());
});

$('.modal.restorePrev.restoreSizePartner').on('hidden.bs.modal', function(e) {
    $('#companySize')
        .val(sessionStorage.getItem('restoreSizePartner'))
        .trigger('chosen:updated');
});

//parnterPreview - tip

$('.modal.restorePrev.restoreTypePartner').on('shown.bs.modal', function(e) {
    var localArr7 = $('#companyType')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreTypePartner', localArr7);
});

$('.modal.restorePrev.restoreTypePartner').on('hidden.bs.modal', function(e) {
    $('#companyType')
        .val(sessionStorage.getItem('restoreTypePartner').split(','))
        .trigger('chosen:updated');
});

//contactPreview - pol

$('.modal.restorePrev.restoreGenderContact').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreGenderContact', $('#genderSelect option:selected').val());
});

$('.modal.restorePrev.restoreGenderContact').on('hidden.bs.modal', function(e) {
    $('#genderSelect')
        .val(sessionStorage.getItem('restoreGenderContact'))
        .trigger('chosen:updated');
});

//contactPreview - prefiks pol

$('.modal.restorePrev.restorePrefixContact').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restorePrefixContact', $('#prefixSelect option:selected').val());
});

$('.modal.restorePrev.restorePrefixContact').on('hidden.bs.modal', function(e) {
    $('#prefixSelect')
        .val(sessionStorage.getItem('restorePrefixContact'))
        .trigger('chosen:updated');
});

//contactPreview - datum rodjenja

$('.modal.restorePrev.restoreBirthdayContact').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreBirthdayDayContact', $('#birthDay option:selected').val());
    sessionStorage.setItem('restoreBirthdayMonthContact', $('#birthMonth option:selected').val());
    sessionStorage.setItem('restoreBirthdayYearContact', $('#birthYear option:selected').val());
});

$('.modal.restorePrev.restoreBirthdayContact').on('hidden.bs.modal', function(e) {
    $('#birthDay')
        .val(sessionStorage.getItem('restoreBirthdayDayContact'))
        .trigger('chosen:updated');
    $('#birthMonth')
        .val(sessionStorage.getItem('restoreBirthdayMonthContact'))
        .trigger('chosen:updated');
    $('#birthYear')
        .val(sessionStorage.getItem('restoreBirthdayYearContact'))
        .trigger('chosen:updated');
});

//contactPreview - titula

$('.modal.restorePrev.restoreTitulaContact').on('shown.bs.modal', function(e) {
    var localArr8 = $('#titula')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreTitulaContact', localArr8);
});

$('.modal.restorePrev.restoreTitulaContact').on('hidden.bs.modal', function(e) {
    $('#titula')
        .val(sessionStorage.getItem('restoreTitulaContact').split(','))
        .trigger('chosen:updated');
});

//contactPreview - valuta

$('.modal.restorePrev.restoreCurrencyContact').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreCurrencyContact', $('#currencySelect option:selected').val());
});

$('.modal.restorePrev.restoreCurrencyContact').on('hidden.bs.modal', function(e) {
    $('#currencySelect')
        .val(sessionStorage.getItem('restoreCurrencyContact'))
        .trigger('chosen:updated');
});

//contactPreview - jezik

$('.modal.restorePrev.restoreLanguageContact').on('shown.bs.modal', function(e) {
    var localArr9 = $('#languageSelect')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreLanguageContact', localArr9);
});

$('.modal.restorePrev.restoreLanguageContact').on('hidden.bs.modal', function(e) {
    $('#languageSelect')
        .val(sessionStorage.getItem('restoreLanguageContact').split(','))
        .trigger('chosen:updated');
});

//contactPreview - tip

$('.modal.restorePrev.restoreTypeContact').on('shown.bs.modal', function(e) {
    var localArr10 = $('#type')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreTypeContact', localArr10);
});

$('.modal.restorePrev.restoreTypeContact').on('hidden.bs.modal', function(e) {
    $('#type')
        .val(sessionStorage.getItem('restoreTypeContact').split(','))
        .trigger('chosen:updated');
});

//contactPreview - veza sa drugim kontaktima

$('.modal.restorePrev.restoreRelationContact').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreRelationContact', $('#fizickoPravnoSelect option:selected').val());
});

$('.modal.restorePrev.restoreRelationContact').on('hidden.bs.modal', function(e) {
    $('#fizickoPravnoSelect')
        .val(sessionStorage.getItem('restoreRelationContact'))
        .trigger('chosen:updated');
});

//finansije - evidentiraj uplatu

$('.modal.restorePrev.restorePaymentFinance').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restorePaymentFinance', $('#fakturaSelect option:selected').val());
});

$('.modal.restorePrev.restorePaymentFinance').on('hidden.bs.modal', function(e) {
    $('#fakturaSelect')
        .val(sessionStorage.getItem('restorePaymentFinance'))
        .trigger('chosen:updated');
});

//obaveze - vezani predmeti

$('.modal.restorePrev.restoreCaseRelFromTask').on('shown.bs.modal', function(e) {
    var localArr11 = $('#caseIds')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreCaseRelFromTask', localArr11);
});

$('.modal.restorePrev.restoreCaseRelFromTask').on('hidden.bs.modal', function(e) {
    $('#caseIds')
        .val(sessionStorage.getItem('restoreCaseRelFromTask').split(','))
        .trigger('chosen:updated');
});

//obaveze - tip

$('.modal.restorePrev.restoreTaskType').on('shown.bs.modal', function(e) {
    var localArr12 = $('.getAllTypesRestore')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreTaskType', localArr12);
});

$('.modal.restorePrev.restoreTaskType').on('hidden.bs.modal', function(e) {
    $('.getAllTypesRestore')
        .val(sessionStorage.getItem('restoreTaskType').split(','))
        .trigger('chosen:updated');
});

//obaveze - prioritet

$('.modal.restorePrev.restorePriorityModal').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restorePriorityModal', $('.restorePriorityClass option:selected').val());
});

$('.modal.restorePrev.restorePriorityModal').on('hidden.bs.modal', function(e) {
    $('.restorePriorityClass')
        .val(sessionStorage.getItem('restorePriorityModal'))
        .trigger('chosen:updated');
});

//obaveze - resursi

$('.modal.restorePrev.restoreResource').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('restoreResource', $('#allResourcesList option:selected').val());
});

$('.modal.restorePrev.restoreResource').on('hidden.bs.modal', function(e) {
    $('#allResourcesList')
        .val(sessionStorage.getItem('restoreResource'))
        .trigger('chosen:updated');
    $('#resourceBusyInfo').addClass('hidden');
    $('#resourceBusyPeriod').addClass('hidden');
    $('#addRepetitionResource').css({ display: 'none' });

    $('.copyRepetition').remove();
    $('#repTaskResourceCopy').prop('checked', false);
    $('#showLabelRepResource').css({ display: 'none' });
    $('#showLabelFlex').css({ display: 'none' });
    $('#saveNewResourceBtn').prop('disabled', false);
});

//obaveze - lokacije

$('.modal.restorePrev.restoreLocationModal').on('hidden.bs.modal', function(e) {
    cancelLocAddAll();
});

//obaveze- alarmi

$('.modal.restorePrev.restoreAlarm').on('hidden.bs.modal', function(e) {
    $('#vremeAlarmaObl')
        .val(0)
        .trigger('chosen:updated');
    $('.copyRepetition').remove();
    $('.customDate').css({
        display: 'none',
    });
    $('#createAlarm').trigger('reset');
    $('#startAlarmTime-error').css({
        display: 'none',
    });
});

//lista obaveza - izmena roka

$('.modal.restorePrev.restoreListModalAllTasks').on('hidden.bs.modal', function(e) {
    $('#endDateTimeB').removeAttr('disabled');
    $('#endTimeB').removeAttr('disabled');
});

//kreiranje nove obaveze - alarm

$('.mozelise').on('click', function(e) {
    $('#vremeAlarmaObl')
        .val(0)
        .trigger('chosen:updated');
    $('#startAlarmTime').val('');
    $('.copyRepetition').remove();
    $('.customDate').css({
        display: 'none',
    });
    $('#createAlarm').trigger('reset');
    $('#startAlarmTime-error').css({
        display: 'none',
    });

    $('#startTimeNewTaskLabel').css({
        color: 'black',
    });
    $('.alarmi-error').css({
        display: 'none',
    });
});

//alarmi lista - dodavanje

$('.modal.restorePrev.restoreAlarmList').on('hidden.bs.modal', function(e) {
    $('#createAlarm').trigger('reset');
    $('.copyRepetition').remove();
});

//kontakti - klijenti - lista

$('.modal.restorePrev.restoreAllContactsNew').on('hidden.bs.modal', function(e) {
    $('#formContactAddFizicko').trigger('reset');
    $('#formContactAddPravno').trigger('reset');

    $('#clientNameWarningRemove').css({
        color: 'black',
    });

    $('#emptyFirstNameContact').css({
        display: 'none',
    });

    $('#clientLastnameWarningRemove').css({
        color: 'black',
    });

    $('#emptyLastNameContact').css({
        display: 'none',
    });

    $('#removeWarningPartnerName').css({
        color: 'black',
    });

    $('#error_shortName').css({
        display: 'none',
    });

    //fizicko lice

    $('#genderContact')
        .val(0)
        .trigger('chosen:updated');
    $('#titula')
        .val(0)
        .trigger('chosen:updated');
    $('#prefixContact')
        .val(0)
        .trigger('chosen:updated');
    $('#birthDay')
        .val(0)
        .trigger('chosen:updated');
    $('#birthMonth')
        .val(0)
        .trigger('chosen:updated');
    $('#birthYear')
        .val(0)
        .trigger('chosen:updated');
    $('#currency')
        .val(0)
        .trigger('chosen:updated');
    $('#language')
        .val(0)
        .trigger('chosen:updated');
    $('#contactType')
        .val(0)
        .trigger('chosen:updated');

    //telefon, email, fax - fizicko

    $('#phoneTypeContact_1')
        .val(0)
        .trigger('chosen:updated');
    $('.phoneContactRestoreR').remove();

    // pravno lice

    $('#alertPIB').addClass('hidden');
    $('#pdv')
        .val(0)
        .trigger('chosen:updated');
    $('#currencyCompany')
        .val(0)
        .trigger('chosen:updated');
    $('#organization_type')
        .val(0)
        .trigger('chosen:updated');
    $('#companySize')
        .val(0)
        .trigger('chosen:updated');
    $('#contactTypeCompany')
        .val(0)
        .trigger('chosen:updated');

    //telefon, email, fax - pravno

    $('#phoneTypeCompany_1')
        .val(0)
        .trigger('chosen:updated');
    $('.phoneCompanyRestoreR').remove();
});

//kontakti - klijenti - partnerPreview

$('.modal.restorePrev.restoreAllContactsNewPartner').on('hidden.bs.modal', function(e) {
    $('#formContactAddFizicko').trigger('reset');
    $('#formContactAddPravno').trigger('reset');

    $('#clientNameWarningRemove').css({
        color: 'black',
    });

    $('#emptyFirstNameContact').css({
        display: 'none',
    });

    $('#clientLastnameWarningRemove').css({
        color: 'black',
    });

    $('#emptyLastNameContact').css({
        display: 'none',
    });

    $('#removeWarningPartnerName').css({
        color: 'black',
    });

    $('#error_shortName').css({
        display: 'none',
    });

    //fizicko lice

    $('#genderContact')
        .val(0)
        .trigger('chosen:updated');

    $('#prefixContact')
        .val(0)
        .trigger('chosen:updated');
    $('#birthDayNew')
        .val(0)
        .trigger('chosen:updated');
    $('#birthMonthNew')
        .val(0)
        .trigger('chosen:updated');
    $('#birthYearNew')
        .val(0)
        .trigger('chosen:updated');
    $('#currency')
        .val(0)
        .trigger('chosen:updated');

    $('#typeNew')
        .find('option:selected')
        .prop('selected', false);
    $('#typeNew').trigger('chosen:updated');
    $('#language')
        .find('option:selected')
        .prop('selected', false);
    $('#language').trigger('chosen:updated');
    $('#titula')
        .find('option:selected')
        .prop('selected', false);
    $('#titula').trigger('chosen:updated');

    //telefon, email, fax - fizicko

    $('#phoneTypeContact_1')
        .val(0)
        .trigger('chosen:updated');
    $('.phoneContactRestoreR').remove();

    // pravno lice

    $('#alertPIB2').addClass('hidden');
    $('#newPdv')
        .val(0)
        .trigger('chosen:updated');
    $('#newCurrencyCompany')
        .val(0)
        .trigger('chosen:updated');
    $('#newOrganization_type')
        .val(0)
        .trigger('chosen:updated');
    $('#newCompanySize')
        .val(0)
        .trigger('chosen:updated');
    $('#companyTypeNew')
        .val(0)
        .trigger('chosen:updated');

    //telefon, email, fax - pravno

    $('#phoneTypeCompany_1')
        .val(0)
        .trigger('chosen:updated');
    $('.phoneCompanyRestoreR').remove();
});

//kontakti - klijenti - contactPreview

$('.modal.restorePrev.restoreAllContactsPrev').on('hidden.bs.modal', function(e) {
    $('#formContactAddFizicko').trigger('reset');
    $('#formContactAddPravno').trigger('reset');

    $('#clientNameWarningRemove').css({
        color: 'black',
    });

    $('#emptyFirstNameContactNew').css({
        display: 'none',
    });

    $('#clientLastnameWarningRemove').css({
        color: 'black',
    });

    $('#emptyLastNameContactNew').css({
        display: 'none',
    });

    $('#removeWarningPartnerName').css({
        color: 'black',
    });

    $('#error_shortName').css({
        display: 'none',
    });

    //fizicko lice

    $('#genderContactNew')
        .val(0)
        .trigger('chosen:updated');
    $('#prefixContactNew')
        .val(0)
        .trigger('chosen:updated');
    $('#birthDayNew')
        .val(0)
        .trigger('chosen:updated');
    $('#birthMonthNew')
        .val(0)
        .trigger('chosen:updated');
    $('#birthYearNew')
        .val(0)
        .trigger('chosen:updated');
    $('#currencyNew')
        .val(0)
        .trigger('chosen:updated');

    $('#typeNew')
        .val('')
        .trigger('chosen:updated');
    $('#languageNew')
        .val('')
        .trigger('chosen:updated');
    $('#titulaNew')
        .val('')
        .trigger('chosen:updated');

    //telefon, email, fax - fizicko

    $('#phoneTypeContact_1')
        .val(0)
        .trigger('chosen:updated');
    $('.phoneContactRestoreR').remove();

    // pravno lice

    $('#alertPIB').addClass('hidden');
    $('#pdv')
        .val(0)
        .trigger('chosen:updated');
    $('#currencyCompany')
        .val(0)
        .trigger('chosen:updated');
    $('#organization_type')
        .val(0)
        .trigger('chosen:updated');
    $('#companySize')
        .val(0)
        .trigger('chosen:updated');
    $('#companyType')
        .val(0)
        .trigger('chosen:updated');

    //telefon, email, fax - pravno

    $('#phoneTypeCompany_1')
        .val(0)
        .trigger('chosen:updated');
    $('.phoneCompanyRestoreR').remove();
});

//predmeti - nacin obracuna

$('.modal.restoreObracunModal').on('shown.bs.modal', function(e) {
    var radioValueObracun = $("input[name='nacinobracuna']:checked").val();
    sessionStorage.setItem('currentObracun', radioValueObracun);

    switch (radioValueObracun) {
        case '1':
            $('#fiksnaSumaValue').hide();
            $('#maxsumaValue').hide();
            $('#satnica').prop('checked', true);
            break;
        case '2':
            $('#fiksnaSumaValue').hide();
            $('#maxsumaValue').show();
            $('#maxsuma').prop('checked', true);
            break;
        case '3':
            $('#maxsumaValue').hide();
            $('#fiksnaSumaValue').show();
            $('#fiksna').prop('checked', true);
            break;
    }
});

$('.modal.restoreObracunModal').on('hidden.bs.modal', function(e) {
    $('#nacinPlacanjaForm').trigger('reset');
});

//predmeti - jezici

$('.modal.restorePrev.restoreCaseLanguage').on('shown.bs.modal', function(e) {
    var localArr13 = $('#language')
        .chosen()
        .val()
        .toString();
    sessionStorage.setItem('restoreLanguageCase', localArr13);
});

$('.modal.restorePrev.restoreCaseLanguage').on('hidden.bs.modal', function(e) {
    $('#language')
        .val(sessionStorage.getItem('restoreLanguageCase').split(','))
        .trigger('chosen:updated');
});

//predmeti - klijent

$('.modal.restorePrev.restoreAddClientCase').on('hidden.bs.modal', function(e) {
    $('#contactsClient')
        .val('')
        .trigger('chosen:updated');
    $('#clientTypeClient')
        .val('')
        .trigger('chosen:updated');
});

//predmeti - druga strana

$('.modal.restorePrev.restoreAddCaseSide').on('hidden.bs.modal', function(e) {
    $('#contactsSecondPage')
        .val('')
        .trigger('chosen:updated');
    $('#contactTypeSecondPage')
        .val('')
        .trigger('chosen:updated');
    $('#contactsZastupnik')
        .val('')
        .trigger('chosen:updated');
});

//predmeti - postupajuce lice

$('.modal.restorePrev.restoreCasePL').on('hidden.bs.modal', function(e) {
    $('#postupajuceLice')
        .val('')
        .trigger('chosen:updated');
    $('#formDodajPostupajuceLice').trigger('reset');
});

//predmeti - vestak

$('.modal.restorePrev.restoreCaseV').on('hidden.bs.modal', function(e) {
    $('#vestak')
        .val('')
        .trigger('chosen:updated');
    $('#ovSelect')
        .val('')
        .trigger('chosen:updated');
    $('#formDodajVestaka').trigger('reset');
});

//predmeti - strucni savetnik

$('.modal.restorePrev.restoreCaseSS').on('hidden.bs.modal', function(e) {
    $('#strucniSavetnik')
        .val('')
        .trigger('chosen:updated');
    $('#formDodajStrucnogSavetnika').trigger('reset');
});

//predmeti - vrsta i podvrsta postupka

$('.modal.restorePrev.restoreCaseVP').on('hidden.bs.modal', function(e) {
    $('#type')
        .val('')
        .trigger('chosen:updated');
    $('#subType')
        .val('')
        .trigger('chosen:updated');
});

//predmeti - zaprecena kazna

$('.modal.restorePrev.restoreCaseZK').on('hidden.bs.modal', function(e) {
    $('#zaprecenaKazna').val('');
    $('#zaprecenaKazna').selectpicker('refresh');
});

//predmeti - zvanicni broj

$('.modal.restorePrev.restoreCaseNumOfficial').on('hidden.bs.modal', function(e) {
    $('#ustanova')
        .val('')
        .trigger('chosen:updated');
    $('#upisnik')
        .val('')
        .trigger('chosen:updated');
    $('#godina')
        .val('')
        .trigger('chosen:updated');
    $('#tipNO')
        .val('')
        .trigger('chosen:updated');
    $('#officialCaseNumForm').trigger('reset');
    $('#pregledContent').html('');
});

//predmeti - nova stavka za naplatu

$('.modal.restorePrev.restoreSN').on('shown.bs.modal', function(e) {
    sessionStorage.setItem('zaposleniValSN', $('#zaposleniSN').val());
});

$('.modal.restorePrev.restoreSN').on('hidden.bs.modal', function(e) {
    $('#valutaRSD')
        .val('RSD')
        .trigger('chosen:updated');
    $('#tipPoslaSN')
        .val('')
        .trigger('chosen:updated');
    $('#nox')
        .val(0)
        .trigger('chosen:updated');
    $('#selectTip')
        .val('Rad')
        .trigger('chosen:updated');
    $('.allow_add_trosak')
        .val('')
        .trigger('chosen:updated');
    $('.podTip').hide();
    $('#zaposleniSN')
        .val(sessionStorage.getItem('zaposleniValSN'))
        .trigger('chosen:updated');

    $('#klijent').html('');
    $.ajax({
        type: 'POST',
        url: '/allPPforCase',
        dataType: 'json',
        async: false,
        data: {
            caseID: $('#ivanCaseID').val(),
        },
    }).done(function(response) {
        response.forEach(element => {
            if (response.length == 1) {
                $('#klijent').append("<option selected value='" + element.clientID + "'>" + element.name + '</option>');
            } else {
                $('#klijent').append("<option value='" + element.clientID + "'>" + element.name + '</option>');
            }
        });

        $('#klijent').trigger('chosen:updated');
    });

    $('.selectAdvTrf')
        .val('')
        .trigger('chosen:updated');
    $('.selectAdvTrf')
        .val('')
        .trigger('chosen:updated')
        .next('div.chosen-container')
        .removeClass('accent');

    $('#originalAdv').html('');
    $('.originalTarifDiv').addClass('hidden');
    $('#originalTarif').html('');
    $('.originalAdvDiv').addClass('hidden');
    $('#loadAdvTrfBox').css({
        display: 'none',
    });
    $('#loadInterniCenovnik').css({
        display: 'none',
    });
    $('.advTarifaRadnjeR').css({
        display: 'none',
    });

    $('.satnicaRemoveVal').val('');
    $('.brojSatiRemoveVal').val('');
    $('.brojMinutaRemoveVal')
        .val(0)
        .trigger('chosen:updated');
    $('.satnicaDiv').addClass('hidden');
    $('#valutaRSD_chosen').removeClass('testreadonly');
});

$('.modal.restorePrev').on('hidden.bs.modal', function(e) {
    var currentOpenModalID = this.id;
    $('.form-control-feedback').hide();
    var searchForForm = '#' + currentOpenModalID;
    $(searchForForm)
        .find('form')
        .trigger('reset');

    if ($(this).hasClass('restoreTaskChgTime')) {
        $('#startTimeB').val('');
        $('#endTimeB').val('');
        $('#endDateTimeB').prop('disabled', false);
        $('#endTimeB').prop('disabled', false);
    }

    if ($(this).hasClass('restoreTaskCopy')) {
        $('#startTimeCopy').val('');
        $('#endTimeCopy').val('');
        $('#endDateCopy').prop('disabled', false);
    }

    if ($(this).hasClass('restoreTaskAlarm')) {
        $('#vremeAlarmaObl_chosen a').removeClass('chosen-single chosen-single-with-deselect chosen-container-active');
        $('#vremeAlarmaObl_chosen a').addClass('chosen-single chosen-single-with-deselect chosen-default');
        $('#vremeAlarmaObl_chosen a span').text('Vreme alarma/podsetnika');
        $('.col-md-6.customDate').css('display', 'none');
        $('.m-portlet.repeticija').css('display', 'none');
        $('.m-radio-inline.ncd').css('display', 'none');
        //$ ("#vremeAlarmaObl_chosen a abbr.search-choice-close").remove();
        $('#alarmiModal li.active-result.result-selected').removeClass('.result-selected');
        $('#alarmiModal #addRepetition').remove();
        $('#startAlarmDate').val('');
        $('#startAlarmTime').val('');
    }

    if ($(this).hasClass('restoreAlarmListAdd')) {
        $('#createAlarm').trigger('reset');
    }

    if ($(this).hasClass('restorePrevLocation2')) {
        $('#addressModalForm2').trigger('reset');
    }

    if ($(this).hasClass('restoreSettingsInstitutionModal')) {
        $('#newType')
            .val(0)
            .trigger('chosen:updated');
        $('#newState')
            .val(0)
            .trigger('chosen:updated');
    }

    if ($(this).hasClass('restoreNewUserModal')) {
        $('#employeeSelectNew')
            .val('')
            .trigger('chosen:updated');
    }

    if ($(this).hasClass('restoreNoticeModal')) {
        $('#imgPreviewDiv').html('');
        $('#uplImg').text('Izaberi');
        $('#removePreview').hide();
    }

    if ($(this).hasClass('restoreSatnicaNew')) {
        $('#addEmplPerHour').trigger('reset');
        $('#currencyPerHour')
            .val(0)
            .trigger('chosen:updated');
    }

    if ($(this).hasClass('restoreContactJMBG')) {
        $('#formJMBG').trigger('reset');
    }

    if ($(this).hasClass('restoreInvoiceModal')) {
        $('#ppSelect')
            .val(0)
            .trigger('chosen:updated');
        $('#fakturaForma').trigger('reset');
    }

    if ($(this).hasClass('restoreAlarmInvoice')) {
        $('#createAlarm').trigger('reset');
    }

    if ($(this).hasClass('restoreNoteModal')) {
        $('#opisPredmetaForm').trigger('reset');
    }

    if ($(this).hasClass('restoreRelationCase')) {
        $('#caseRelationForm').trigger('reset');
    }

    if ($(this).hasClass('restoreAlarmFromCase')) {
        $('.copyRepetition').remove();
    }

    if ($(this).hasClass('restoreCommentReply')) {
        tinymce.get('comment_body_re').setContent('');
    }

    if ($(this).hasClass('restoreCommentReplyCase')) {
        tinymce.get('editCaseText').setContent('');
    }
});

/* end modali ukloni sadrzaj */

// pib provera karaktera

var getPibEl = document.getElementById('pib');
var getPibElPartner = document.getElementById('newPib');
var getPibElFaktura = document.getElementById('ppPib');

function checkPibLength(pibValue, infoDivID) {
    var pibValue = pibValue.value;
    var infoDiv = document.getElementById(infoDivID);

    if (pibValue.length < 9 || pibValue.length > 9) {
        infoDiv.classList.remove('hidden');
    } else {
        infoDiv.classList.add('hidden');
    }
}

if (getPibEl !== null) {
    getPibEl.addEventListener('keyup', function() {
        checkPibLength(getPibEl, 'alertPIB');
    });
}

if (getPibElPartner !== null) {
    getPibElPartner.addEventListener('keyup', function() {
        checkPibLength(getPibElPartner, 'alertPIB2');
    });
}

if (getPibElFaktura !== null) {
    getPibElFaktura.addEventListener('keyup', function() {
        checkPibLength(getPibElFaktura, 'alertPIB');
    });
}

// end pib provera karaktera

$(document).on('click', '#predmetToggle', function() {
    if ($('#predmetToggle').hasClass('m-menu__item--open') == true) {
        $('#toggleOC').removeClass('la-angle-right');
        $('#toggleOC').addClass('la-angle-down');
    } else {
        $('#toggleOC').addClass('la-angle-right');
        $('#toggleOC').removeClass('la-angle-down');
    }
});

$(document).on('click', '#obavezaToggle', function() {
    if ($('#obavezaToggle').hasClass('m-menu__item--open') == true) {
        $('#toggleOCO').removeClass('la-angle-right');
        $('#toggleOCO').addClass('la-angle-down');
    } else {
        $('#toggleOCO').addClass('la-angle-right');
        $('#toggleOCO').removeClass('la-angle-down');
    }
});

function validateNumber(el, evt, allowNegativ = false, digitsAfterDecimal = 1) {
    if (el.value === '.') {
        el.value = '0.';
    }
    if (el.value === ',') {
        el.value = '0,';
    }

    var charCode = evt.which ? evt.which : evt.keyCode;
    var number = el.value.split('.');
    var number2 = el.value.split(',');

    if (charCode == 37 || charCode == 39) {
        return true;
    }

    if (allowNegativ && charCode == 45) {
        return true;
    }

    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }

    if ((number.length > 1 && charCode == 46) || (number2.length > 1 && charCode == 44)) {
        return false;
    }

    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf('.');
    var dotPos2 = el.value.indexOf(',');

    if (charCode == 46 || charCode == 44) {
        if (dotPos !== -1 || dotPos2 !== -1) {
            return false;
        }
    }

    if ((caratPos > dotPos && dotPos > -1 && number[1].length > digitsAfterDecimal) || (caratPos > dotPos2 && dotPos2 > -1 && number2[1].length > digitsAfterDecimal)) {
        if (charCode == 8) {
            return true;
        }
        return false;
    }
    return true;
}

function validateNumberRobno(el, evt) {
    if (el.value === '.') {
        el.value = '0.';
    }
    if (el.value === ',') {
        el.value = '0,';
    }

    var charCode = evt.which ? evt.which : evt.keyCode;
    var number = el.value.split('.');
    var number2 = el.value.split(',');
    if (charCode == 37 || charCode == 39) {
        return true;
    }

    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }

    if ((number.length > 1 && charCode == 46) || (number2.length > 1 && charCode == 44)) {
        return false;
    }

    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf('.');
    var dotPos2 = el.value.indexOf(',');

    if (charCode == 46 || charCode == 44) {
        if (dotPos !== -1 || dotPos2 !== -1) {
            return false;
        }
    }

    if ((caratPos > dotPos && dotPos > -1 && number[1].length > 3) || (caratPos > dotPos2 && dotPos2 > -1 && number2[1].length > 3)) {
        if (charCode == 8) {
            return true;
        }
        return false;
    }
    return true;
}

function validateNumber3Decimals(el, evt) {
    if (el.value === '.') {
        el.value = '0.';
    }
    if (el.value === ',') {
        el.value = '0,';
    }

    var charCode = evt.which ? evt.which : evt.keyCode;
    var number = el.value.split('.');
    var number2 = el.value.split(',');
    if (charCode == 37 || charCode == 39) {
        return true;
    }

    if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }

    if ((number.length > 1 && charCode == 46) || (number2.length > 1 && charCode == 44)) {
        return false;
    }

    //get the carat position
    var caratPos = getSelectionStart(el);
    var dotPos = el.value.indexOf('.');
    var dotPos2 = el.value.indexOf(',');

    if (charCode == 46 || charCode == 44) {
        if (dotPos !== -1 || dotPos2 !== -1) {
            return false;
        }
    }

    if ((caratPos > dotPos && dotPos > -1 && number[1].length > 2) || (caratPos > dotPos2 && dotPos2 > -1 && number2[1].length > 2)) {
        if (charCode == 8) {
            return true;
        }
        return false;
    }
    return true;
}

function calcNoRound(theform) {
    var num = theform;
    var with2Decimals = num.toString().match(/^-?\d+(?:\.\d{0,2})?/)[0];
    return with2Decimals;
}

function formaNumber(el, digitsAfterDecimal = 2) {
    if (!$(el).hasClass('startNumT')) {
        if (!$(el).hasClass('noFormat')) {
            if (isNaN($(el).val()) || $(el).val() == '') {
                el.value = parseFloat(0).toFixed(digitsAfterDecimal);
            } else {
                if (window.roundCut == true) {
                    el.value = calcNoRound(parseFloat(el.value));
                } else {
                    el.value = parseFloat(el.value).toFixed(digitsAfterDecimal);
                }
            }
        }
    }
}

function validateOnlyNumbers(el, evt) {
    var targetValue = evt.target.value.toString();
    var charCode = evt.which ? evt.which : evt.keyCode;

    if (charCode == 44 || charCode == 46 || targetValue.includes('.') || targetValue.includes(',')) {
        return false;
    }

    return true;
}

function validateOnlyIntegerNumbers(el, evt) {
    var targetValue = evt.target.value.toString();

    var charCode = evt.which ? evt.which : evt.keyCode;
    var firstChar = targetValue.charAt(0);

    if (targetValue === '') {
        if (charCode < 49 || charCode > 57 || targetValue.includes('.') || targetValue.includes(',')) {
            return false;
        }
    } else {
        if (charCode < 48 || charCode > 57 || targetValue.includes('.') || targetValue.includes(',')) {
            return false;
        }

        return true;
    }
}

//thanks: http://javascript.nwbox.com/cursor_position/
function getSelectionStart(o) {
    if (o.createTextRange) {
        var r = document.selection.createRange().duplicate();
        r.moveEnd('character', o.value.length);
        if (r.text == '') return o.value.length;
        return o.value.lastIndexOf(r.text);
    } else return o.selectionStart;
}

function validetePhoneNum(event) {
    return false;
}

jQuery(document).ready(function() {
    var getURL = window.location.toString();
    var splitURL = getURL.split('?');

    $('#savePaging').on('click', e => {
        var isChecked = $('#savePaging').is(':checked');
        var list = $('#savePaging').attr('list');
        list = list.replace(/\s/g, '');
        var saveNumber = null;
        var oldList = list;
        if (isChecked) {
            if (list.includes('Approving')) {
                list = list.replace('Approving', '');
            }
            saveNumber = $('#' + list)
                .DataTable()
                .page.info().length;
        }
        list = oldList;
        savePagingNumber(list, saveNumber);
        swal({
            title: '',
            text: 'Uspešno sačuvano.',
            type: 'success',
            timer: 2000,
        });
    });

    if (splitURL[1] !== undefined && splitURL[1].toString().includes('trID')) {
        var urlPart = splitURL[splitURL.length - 1];
        var splitURL = urlPart.split('=');
        var transactionID = parseInt(splitURL[1]);
        var typeTr = splitURL[0].split('-')[1];
        var dataTransaction = '';

        //podaci za izlaz

        $.ajax({
            url: '/getTransactionInfoMail/' + transactionID + '/' + typeTr,
            method: 'GET',
            async: false,
            success: function(data) {
                let opis = !data.opis ? '/' : data.opis;
                dataTransaction = `<p style="text-align: left;"><strong>Podaci</strong><br>Naziv blagajne: <a href='/allFinansije/viewCashDesk/${data.deskID}'>${
                    data.deskName
                }</a><br>Datum i vreme transakcije: ${data.date} <br> Iznos: ${data.iznos} ${data.curr} <br> Kreator: ${data.creator}<br>Opis: ${opis}<br>`;
            },
            error: function(err) {
                alert(err.responseText);
            },
        });

        //

        swal({
            title: 'Potvrda ' + typeTr + 'a',
            html: dataTransaction + '<br>Da li ste sigurni da želite da potvrdite ' + typeTr + ' ?</p>',
            type: 'warning',
            showCancelButton: !0,
            cancelButtonText: "<span><i class='la la-thumbs-down'></i><span>Odustani</span></span>",
            confirmButtonText: 'Potvrdi',
        }).then(e => {
            if (e.value) {
                $.ajax({
                    url: '/updateAuthCashMail/' + transactionID + '/returnMsg' + '/' + typeTr,
                    method: 'GET',
                    success: function(data) {
                        if (data == 'updated') {
                            swal({
                                title: '',
                                text: 'Uspešno ste potpisali ' + typeTr + '.',
                                type: 'success',
                                confirmButtonClass: 'btn btn-secondary m-btn m-btn--wide',
                                timer: 2000,
                            });

                            if (typeof tabelablagajne != 'undefined') tabelablagajne.init();
                        } else if (data == 'not updated') {
                            typeTr = typeTr.charAt(0).toUpperCase() + typeTr.slice(1);

                            swal({
                                title: '',
                                text: typeTr + ' je već potpisan',
                                type: 'warning',
                                confirmButtonClass: 'btn btn-secondary m-btn m-btn--wide',
                                timer: 2000,
                            });
                        }
                    },
                });
            }
        });
    }

    // nakon zatvaranja print modala sakrivam div sa filterima pomocu funkcije afterPrint()
    document.getElementsByTagName('BODY')[0].onafterprint = function() {
        afterPrint();
    };

    //KLASA ZA INPUT TEXT KOJA IMA OGRANICENJE ZA SAMO BROJEVE
    $('.number-only').keypress(function(e) {
        var charCode = e.which ? e.which : event.keyCode;
        if (String.fromCharCode(charCode).match(/[^0-9]/g)) return false;
    });

    $(document).on('keypress', '.validateNumber', function(e) {
        return validateNumber(this, e);
    });
    $(document).on('change', '.validateNumber', function(e) {
        formaNumber(this);
    });

    $(document).on('keypress', '.validateNumberNdecimal', function(e) {
        const attr = $(this).attr('data-Ndecimal');
        const numberOfdecimals = attr !== undefined ? parseInt(attr) - 1 : 1;
        return validateNumber(this, e, false, numberOfdecimals);
    });
    $(document).on('change', '.validateNumberNdecimal', function(e) {
        const attr = $(this).attr('data-Ndecimal');
        const numberOfdecimals = attr !== undefined ? parseInt(attr) : 2;
        formaNumber(this, numberOfdecimals);
    });

    // validate number with negative
    $(document).on('keypress', '.validateNumberWithNegative', function(e) {
        return validateNumber(this, e, true);
    });
    $(document).on('change', '.validateNumberWithNegative', function(e) {
        formaNumber(this);
    });

    $(document).on('keypress', '.validateNumberRobno', function(e) {
        return validateNumberRobno(this, e);
    });

    $(document).on('keypress', '.validateNumber3Decimals', function(e) {
        return validateNumber3Decimals(this, e);
    });

    $('.validateOnlyNumbers').keypress(function(e) {
        return validateOnlyNumbers(this, e);
    });

    $(document).on('keypress', '.validateOnlyIntegerNumbers', function(e) {
        return validateOnlyIntegerNumbers(this, e);
    });

    $('.validateNumber').blur(function(event) {
        if (
            event.target.id != 'prihodPredmeta' &&
            event.target.id != 'editSuma' &&
            $(this)
                .val()
                .includes(',')
        ) {
            $(this).val(
                $(this)
                    .val()
                    .replace(',', '.')
                    .replace('.', ''),
            );
        }
    });

    $('.validateNumber').bind('cut copy paste', function(e) {
        //DEL-5576 Moze paste na odredjenim $(".validateNumber") poljima
        if (!$(e.target).hasClass('grantPaste')) {
            alert('Nije moguće kopiranje u ovo polje');
            e.preventDefault();
        }
    });

    $(document).on('keydown', '.validetePhoneNum', function(event) {
        var key = window.event ? event.keyCode : event.which;
        if (
            key === 37 ||
            key === 39 ||
            key === 8 ||
            key === 96 ||
            key === 97 ||
            key === 98 ||
            key === 99 ||
            key === 100 ||
            key === 101 ||
            key === 102 ||
            key === 103 ||
            key === 104 ||
            key === 105 ||
            key === 111 ||
            key === 187 ||
            key === 107 ||
            key === 109 ||
            key === 46 ||
            key === 61 ||
            key === 173 ||
            key === 189
        ) {
            return true;
        } else if (key < 48 || key > 57) {
            return false;
        } else {
            return true;
        }
    });

    $('.validetePhoneNum').bind('cut copy paste', function(e) {
        alert('Nije moguće kopiranje u ovo polje');
        e.preventDefault();
    });

    // collapsed sidebar hover multilevel
    $('.m-menu__nav--dropdown-submenu-arrow > .m-menu__item').hover(
        function() {
            $(this)
                .addClass('m-menu__item--submenu')
                .addClass('m-menu__item--hover');
        },
        function() {
            $(this)
                .removeClass('m-menu__item--submenu')
                .removeClass('m-menu__item--hover');
        },
    );
    allowed_extensionsNew = /(\.|\/)(gif|jpe?g|png|7z|doc|docx|zip|pdf|xlsx|bmp|txt|xls|odt|ods|odp|eml|msg|mp3|mp4|bmp|apk|csv|wmv|mpg|mpeg|xml|dotx|dot|xps|rtf|wps|rar|tif|pptx|mkv|avi|mov|qt|mp2|mpe|mpv|m2v|3gp|jfif|ppt|roz|pub|dot|wbk|docm|dotx|dotm|docb|xlt|xlm|xlsm|xltx|xltm|xlsb|xla|xlam|xll|xlw|pot|pps|pptm|potx|potm|ppam|ppsx|ppsm|sldx|sldm|xps|accdb|accdt|accdr|accde|accdb|chm|dwg|db|gitignore|text|tiff|log|ink|bak|dxf|ncd|scan|cdr|ai|oxps|QRP|mdb|dwfx|asice|dcx|dct)$/i;
    window.allowed_extensionsNew = /(\.|\/)(gif|jpe?g|png|7z|doc|docx|zip|pdf|xlsx|bmp|txt|xls|odt|ods|odp|eml|msg|mp3|mp4|bmp|apk|csv|wmv|mpg|mpeg|xml|dotx|dot|xps|rtf|wps|rar|tif|pptx|mkv|avi|mov|qt|mp2|mpe|mpv|m2v|3gp|html|htm|mht|mhtml|jfif|ppt|roz|pub|dot|wbk|docm|dotx|dotm|docb|xlt|xlm|xlsm|xltx|xltm|xlsb|xla|xlam|xll|xlw|pot|pps|pptm|potx|potm|ppam|ppsx|ppsm|sldx|sldm|xps|accdb|accdt|accdr|accde|accdb|chm|dwg|db|gitignore|text|tiff|log|ink|bak|dxf|ncd|scan|cdr|ai|oxps|QRP|mdb|dwfx|asice|dcx|dct)$/i;
    allowed_extensionsNew_notice = /(\.|\/)(gif|jpe?g|png|bmp)$/i;
    allowed_extensionsNew_notice_file = /(\.|\/)(7z|doc|docx|zip|pdf|xlsx|txt|xls|odt|ods|odp|eml|msg|mp3|mp4|bmp|apk|csv|wmv|mpg|mpeg|xml|dotx|dot|xps|rtf|wps|rar|tif|pptx|mkv|avi|mov|qt|mp2|mpe|mpv|m2v|3gp|jfif|ppt|gif|jpe?g|png|roz|pub|dot|wbk|docm|dotx|dotm|docb|xlt|xlm|xlsm|xltx|xltm|xlsb|xla|xlam|xll|xlw|pot|pps|pptm|potx|potm|ppam|ppsx|ppsm|sldx|sldm|xps|accdb|accdt|accdr|accde|accdb|chm|dwg|db|gitignore|text|tiff|log|ink|bak|dxf|ncd|scan|cdr|ai|oxps|QRP|mdb|dwfx|asice|dcx|dct)$/i;
    allowed_extensions_KEC = /(jpe?g|png|7z|zip|pdf|txt|mp3|mp4|apk|csv|wmv|mpg|mpeg|xml|rtf|rar|tif|mkv|avi|mov|mp2|mpe|mpv|m2v|3gp|roz|xps|accdt|accdr|accde|accdb|chm|db|gitignore|text|tiff|log|ncd|oxps|mdb|asice|asics)$/i;
    window.MAX_FILES_TO_UPLOAD_DRAG_AND_DROP = 50;

    $('div.input-group.date .input-group-append').click(function(event) {
        event.preventDefault();

        var input = $(this)
            .parents('.input-group.date')
            .children('input');

        if (input.attr('disabled')) {
            return false;
        }

        $(this)
            .parents('.input-group.date')
            .children("input[type!='hidden']")
            .first()
            .datetimepicker('show');
    });

    // store the currently selected tab in the hash value
    $('.tabSubClick a').click(function() {
        $('html').animate({ scrollTop: 0 }, 1);
    });

    $(document).on('keypress', 'form', function(event) {
        if (event.originalEvent.target.type == 'textarea') {
            return true;
        }
        return event.keyCode != 13;
    });

    if ($('footer').find('.nav-item').length == 0) {
        $('footer').hide();
    } else {
        $('footer').show();
    }
    /* Služi da gasi session flash success divove sa porukama */
    setTimeout(function() {
        $('._autoClose').fadeOut(2000, 'linear');
    }, 1000);

    /* Služi da gasi success divove koji se naknadno uključuju */
    setInterval(function() {
        if ($('.cssAutoClose').is(':visible')) {
            setTimeout(function() {
                $('.cssAutoClose').fadeOut(2000, 'linear');
            }, 1000);
        }
    }, 250);

    $('#podaciOLicenci').on('shown.bs.modal', function() {
        axios.get('/getStatusOfTimestamps').then(data => {
            const { totalCredits, usedCredits, remainingCredits } = data.data;
            $('#totalCredits').html(totalCredits);
            $('#usedCredits').html(usedCredits);
            $('#remainingCredits').html(remainingCredits);
        });
    });

    $(document).on("focus input change keypress cut copy paste", "textarea.resizable_textarea", function(event) {
        event.target.style.height = "fit-content";
        event.target.style.height = event.target.scrollHeight + "px";
    });
});

if ($('body').hasClass('m-brand--minimize')) {
    $('#plusAddNewAlarmSideMini').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini2').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini3').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini4').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini4a').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini5').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini6').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini7').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini8').addClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini9').addClass('alarmPlusChangeMini');
    $('#kancelarkoViber').hide();
} else {
    $('#plusAddNewAlarmSideMini').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini2').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini3').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini4').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini4a').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini5').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini6').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini7').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini8').removeClass('alarmPlusChangeMini');
    $('#plusAddNewAlarmSideMini9').removeClass('alarmPlusChangeMini');
    $('#kancelarkoViber').show();
}

Date.prototype.addHours = function(h) {
    this.setTime(this.getTime() + h * 60 * 60 * 1000);
    return this;
};

function focusMe(element) {
    if (element.find('[data-autofocus="true"]').is(':visible')) {
        element.find('[data-autofocus="true"]').focus();
    } else {
        if ($(element.find('[data-autofocus="true"]')[0]).prev('.mce-tinymce').length > 0) {
            tinymce.get($(element.find('[data-autofocus="true"]')[0]).attr('id')).focus();
        }
        var attr = element.find('[data-autofocus="true"]').attr('multiple');

        if (typeof attr !== typeof undefined && attr !== false) {
            //  alert("do1")
            element
                .find('[data-autofocus="true"]')
                .next('.chosen-container')
                .css('border', '1px solid #66afe9');
        } else {
            element.find('[data-autofocus="true"]').trigger('chosen:activate');
        }
    }
}

$('.modal').on('shown.bs.modal', function() {
    focusMe($(this));
});

$('#beta-banner').on('click', function() {
    $('#beta-modal').modal();
});

$("[name='choseForma']").change(function() {
    var modal = $(this).parents('.modal');
    focusMe(modal);
});

$("[name='passwordResetType']").change(function() {
    var modal = $(this).parents('.modal');
    focusMe(modal);
});

$('.nacinobracuna').change(function() {
    if ($("[name='nacinobracuna']:checked").val() == 2) {
        $('#minValue').focus();
    }

    if ($("[name='nacinobracuna']:checked").val() == 3) {
        $('#fiksnaValue').focus();
    }
});
/**
 *
 * @param {*} value
 * @param {*} element
 * Extenzija required metoda za validaciju
 * originalna ne podržava samo space
 */
function strip(html) {
    var tmp = document.createElement('DIV');
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || '';
}
$.validator.methods.required = function(value, element) {
    value = strip(value).replace(/\s/g, '');
    if (value == '' || !value) {
        return false;
    }

    if ($(element).find(':selected').length == 0) {
        if (!value.replace(/\s/g, '').length) {
            return false;
        } else {
            return true;
        }
    } else {
        if (!value.replace(/\s/g, '').length) {
            return false;
        } else {
            return true;
        }
    }
};

$('.menu').on('mousedown', function(event) {
    var type = $(this).data('type');

    switch (type) {
        case 'cases':
            if (event.which == 1) {
                location.href = '/myCases';
            }
            if (event.which == 2) {
                window.open('/myCases', '_blank');
            }
            break;
        case 'tasks':
            if (event.which == 1) {
                location.href = '/myTasks';
            }
            if (event.which == 2) {
                window.open('/myTasks', '_blank');
            }
            break;
        case 'finances':
            if (event.which == 1) {
                location.href = '/allFinansije';
            }
            if (event.which == 2) {
                window.open('/allFinansije', '_blank');
            }
            break;
        case 'others':
            if (event.which == 1) {
                location.href = '/institutions';
            }
            if (event.which == 2) {
                window.open('/institutions', '_blank');
            }
            break;
        case 'kadrovik':
            if (event.which == 1) {
                location.href = '/employees';
            }
            if (event.which == 2) {
                window.open('/employees', '_blank');
            }
            break;
        case 'kadrovik-evidencije':
            if (event.which == 1) {
                location.href = '/kadrovik/casoviRada';
            }
            if (event.which == 2) {
                window.open('/kadrovik/casoviRada', '_blank');
            }
            break;
        case 'kadrovik-izvestaji-odsustva':
            location.href = '/kadrovik/izvestajiOdsustva';
            break;
        case 'kadrovik-orv':
            if (event.which == 1) {
                location.href = '/kadrovik/organizacijaRadnogVremena';
            }
            if (event.which == 2) {
                window.open('/kadrovik/organizacijaRadnogVremena', '_blank');
            }
            break;

        case 'kadrovik-dnevna-evidencija-zaposlenih':
            if (event.which == 1) {
                location.href = '/kadrovik/evidencijaPrisutnostiZaposlenih';
            }
            break;

        case 'kadrovik-odsustva':
            if (event.which == 1) {
                location.href = '/kadrovik/odsustvaZahtevi';
            }
            break;

        case 'dokumenti':
            if (event.which == 1) {
            }
            if (event.which == 2) {
            }
            break;
        default:
    }
});

$('#m_aside_left_minimize_toggle').on('click', function() {
    if ($('body').hasClass('m-brand--minimize')) {
        $('#plusAddNewAlarmSideMini').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini2').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini3').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini4').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini4a').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini5').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini6').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini7').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini8').addClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini9').addClass('alarmPlusChangeMini');
    } else {
        $('#plusAddNewAlarmSideMini').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini2').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini3').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini4').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini4a').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini5').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini6').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini7').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini8').removeClass('alarmPlusChangeMini');
        $('#plusAddNewAlarmSideMini9').removeClass('alarmPlusChangeMini');
    }
});

function collapseToggle() {
    if ($('body').hasClass('m-brand--minimize')) {
        state = 'maxi';
        $('#kancelarkoViber').hide();
    } else {
        state = 'mini';
        $('#kancelarkoViber').show();
    }

    $.ajax({
        type: 'POST',
        url: '/sidebar-state',
        data: {
            sidebarState: state,
        },
    }).done(function(response) {});
}

$.fn.datetimepicker.defaults = {
    weekStart: 1,
    language: 'rs',
    daysOfWeekHighlighted: '0,6',
};

$('#notificationHelp').on('click', function() {
    $('#notificationHelpModal').modal();
});

// sakrivam div koji kreiram dinamicki za filtere kod print-a
function afterPrint() {
    $('#printDiv').hide();
}

function stampajTabelu() {
    $('#archivalBookTable_length').hide();
    $('#archivalBookTable_filter').hide();
    $('#archivalBookTable_info').hide();
    $('.pagination').hide();
    $('tr th:nth-child(9)').hide();
    $('tr td:nth-child(9)').hide();
    $('.dataTables_empty').hide();

    window.print();
    $('#archivalBookTable_length').show();
    $('#archivalBookTable_filter').show();
    $('#archivalBookTable_info').show();
    $('.pagination').show();
    $('tr th:nth-child(9)').show();
    $('tr td:nth-child(9)').show();
    $('.dataTables_empty').show();
}

function printList() {
    window.print();
}

$(function() {
    document.body.onkeydown = function(e) {
        //gasenje swal modala na enter
        if (e.keyCode == 13) {
            if (Swal.isVisible()) {
                Swal.close();
            }
        }
    };

    $('#finansije-link').on('click', function(e) {
        //finansijeUrl stoji u sidebar.blade.php
        e.preventDefault();
        if (e.target.className == 'm-menu__link-text') {
            window.location.href = finansijeUrl;
        } else {
            window.location.href = finansijeUrl + '?modal=true';
        }
        //
        return false;
    });

    function returnOldValue(words, obj) {
        var value = [];
        for (i = 0; i < words.length; i++) {
            value.push(words[i].substring(0, 30));
        }
        obj.val(value.join(' '));
    }

    $(document).on('keyup change', '.validLimitWord', function() {
        let value = $(this).val();
        let words = value.split(' ');

        for (i = 0; i < words.length; i++) {
            if (words[i].length > 30) {
                returnOldValue(words, $(this));

                if ($(this).siblings('#wordLimit').length == 0) {
                    $(this).after('<div id="wordLimit" class="form-control-feedback">Reči u nazivu mogu sadržati maksimalo 30 karaktera</div>');
                }
                // break;
            } else {
                $('#wordLimit').remove();
            }
        }
    });

    $(document).on('click', '.confirmAuth', function(event) {
        event.preventDefault();
        var transactionID = $(this).attr('dataid');
        var typeTr = $(this).attr('typeTr');

        //podaci za izlaz

        $.ajax({
            url: '/getTransactionInfoMail/' + transactionID + '/' + typeTr,
            method: 'GET',
            async: false,
            success: function(data) {
                let opis = !data.opis ? '/' : data.opis;
                dataTransaction = `<p style="text-align: left;"><strong>Podaci</strong><br>Naziv blagajne: <a href='/allFinansije/viewCashDesk/${data.deskID}'>${
                    data.deskName
                }</a><br>Datum i vreme transakcije: ${data.date} <br> Iznos: ${data.iznos} ${data.curr} <br> Kreator: ${data.creator}<br>Opis: ${opis}<br>`;
            },
            error: function(err) {},
        });

        //

        swal({
            title: 'Potvrda ' + typeTr + 'a',
            html: dataTransaction + '<br>Da li ste sigurni da želite da potvrdite ' + typeTr + ' ?</p>',
            type: 'warning',
            showCancelButton: !0,
            cancelButtonText: "<span><i class='la la-thumbs-down'></i><span>Odustani</span></span>",
            confirmButtonText: 'Potvrdi',
        }).then(e => {
            if (e.value) {
                $.ajax({
                    url: '/updateAuthCash/' + transactionID + '/' + typeTr,
                    method: 'GET',
                    success: function(data) {
                        if (data >= 0) {
                            swal({
                                title: '',
                                text: 'Uspešno ste potpisali ' + typeTr + '.',
                                type: 'success',
                                confirmButtonClass: 'btn btn-secondary m-btn m-btn--wide',
                                timer: 2000,
                            });
                        }

                        if (typeof tabelablagajne != 'undefined') tabelablagajne.init();
                    },
                });
            }
        });
    });
});

//Sluzi za toggle kalendara(datepicker-a). Kada se otvori na klik pa se zatvori, ova f-ja omogucava da se ponovo otvori.
$(function() {
    let cnt = 0;

    $(document).on('click', 'input', function() {
        let element = $(this);

        if ($(this).attr('id')) {
            let id = $(this)
                .attr('id')
                .toLowerCase();
            //Gadjamo da u id-u postoji [date, time , alarm] string. Ovde dodati eventualno jos neki.
            if (id.includes('date') || id.includes('time') || id.includes('alarm')) {
                cnt++;
                //Ukoliko se promeni fokus brojac vracamo na 0
                $(element).on('blur', function() {
                    cnt = 0;
                });

                if (cnt == 2) {
                    cnt = 0;
                    $(element).blur();
                }
            }
        }
        //Gadjamo klasu 'rUtil' ukoliko ne postoji id u kom postoji [date, time , alarm] string. Ovde dodati eventualno jos neku klasu.
        else if (element.hasClass('rUntil')) {
            cnt++;
            //Ukoliko se promeni fokus brojac vracamo na 0
            $(element).on('blur', function() {
                cnt = 0;
            });
            if (cnt == 2) {
                cnt = 0;
                $(element).blur();
            }
        }
    });
});

//Menu toggle za delovodnik sidebar
$(document).ready(function() {
    if ($('#documentToggle').hasClass('m-menu__item--open') == true) {
        $('#toggleAr').removeClass('la-angle-right');
        $('#toggleAr').addClass('la-angle-down');
    } else {
        $('#toggleAr').addClass('la-angle-right');
        $('#toggleAr').removeClass('la-angle-down');
    }

    //klikom na dokumneti u sidebar-u se otvara dropdown
    $('#documentRootSidebar').click(function(e) {
        if ($('#documentToggle').hasClass('m-menu__item--open')) {
            $('#documentSubMenu').css('display', 'none');
        } else {
            $('#documentSubMenu')
                .css('display', 'block')
                .css('overflow', 'visible');
        }

        $('#documentToggle').toggleClass('m-menu__item--open');
    });

    $('#finansije-linkssssssss').on('click', function(e) {
        //finansijeUrl stoji u sidebar.blade.php
        e.preventDefault();
        if (e.target.className == 'm-menu__link-text') {
            window.location.href = finansijeUrl;
        } else {
            window.location.href = finansijeUrl + '?modal=true';
        }
        //
        return false;
    });
});

$(document).on('click', '#documentToggle', function() {
    if ($('#documentToggle').hasClass('m-menu__item--open') == true) {
        $('#toggleAr').removeClass('la-angle-right');
        $('#toggleAr').addClass('la-angle-down');
    } else {
        $('#toggleAr').addClass('la-angle-right');
        $('#toggleAr').removeClass('la-angle-down');
    }
});

$('#loadLastReadDocuments').on('click', function() {
    // ajax za documente
    $.ajax({
        url: '/getLastReadDocuments',
        type: 'GET',
    }).done(function(response) {
        $('#lastReadDocuments').html(response);
    });
});

$('#detailsLastRead').on('click', function() {
    $('#detailsLastReadModal').modal();
});

//blagajna - modal za opis autorizovanog odobravanja u notifikaciji

function opisPotvrdeIzlaza(transID) {
    $('#modalDescAuthorizedCashDesk').modal();

    $('#descAuthorizedBody-loader').show();
    $('#descAuthorizedBody').hide();

    $.ajax({
        url: '/getCashDeskTransactionDesc',
        method: 'post',
        data: { transactionID: transID },
    }).done(function(response) {
        let data = JSON.parse(response);

        let creator = data.creator;
        let datum = data.transactionDate;
        let suma = data.izlaz;
        let curr = data.curr;
        let opis = data.opis != null ? data.opis : '/';

        $('#descAuthorized-creator').text(creator);
        $('#descAuthorized-created').text(datum);
        $('#descAuthorized-suma').text(suma);
        $('#descAuthorized-curr').text(curr);
        $('#descAuthorized-opis').text(opis);

        $('#descAuthorizedBody').show();
        $('#descAuthorizedBody-loader').hide();
    });
}

// Funkcije za prevođenje sa latinice na ćirilicu
/**
 * Ćirilica u latinicu
 * @param word
 * @returns {string}
 */
function cyrToLat(word) {
    var answer = '',
        a = {};
    // velika slova
    a['А'] = 'A';
    a['Б'] = 'B';
    a['В'] = 'V';
    a['Г'] = 'G';
    a['Д'] = 'D';
    a['Ђ'] = 'Đ';
    a['Е'] = 'E';
    a['Ж'] = 'Ž';
    a['З'] = 'Z';
    a['И'] = 'I';
    a['Ј'] = 'J';
    a['К'] = 'K';
    a['Л'] = 'L';
    a['Љ'] = 'Lj';
    a['М'] = 'M';
    a['Н'] = 'N';
    a['Њ'] = 'Nj';
    a['О'] = 'O';
    a['П'] = 'P';
    a['Р'] = 'R';
    a['С'] = 'S';
    a['Т'] = 'T';
    a['Ћ'] = 'Ć';
    a['У'] = 'U';
    a['Ф'] = 'F';
    a['Х'] = 'H';
    a['Ц'] = 'C';
    a['Ч'] = 'Č';
    a['Џ'] = 'Dž';
    a['Ш'] = 'Š';

    // mala slova
    a['а'] = 'a';
    a['б'] = 'b';
    a['в'] = 'v';
    a['г'] = 'g';
    a['д'] = 'd';
    a['ђ'] = 'đ';
    a['е'] = 'e';
    a['ж'] = 'ž';
    a['з'] = 'z';
    a['и'] = 'i';
    a['ј'] = 'j';
    a['к'] = 'k';
    a['л'] = 'l';
    a['љ'] = 'lj';
    a['м'] = 'm';
    a['н'] = 'n';
    a['њ'] = 'nj';
    a['о'] = 'o';
    a['п'] = 'p';
    a['р'] = 'r';
    a['с'] = 's';
    a['т'] = 't';
    a['ћ'] = 'ć';
    a['у'] = 'u';
    a['ф'] = 'f';
    a['х'] = 'h';
    a['ц'] = 'c';
    a['ч'] = 'č';
    a['џ'] = 'dž';
    a['ш'] = 'š';

    for (i in word) {
        if (word.hasOwnProperty(i)) {
            if (a[word[i]] === undefined) {
                answer += word[i];
            } else {
                answer += a[word[i]];
            }
        }
    }

    return answer;
}

/**
 * Latinica u ćirilicu
 * @param word
 * @returns {string}
 */
function latToCyr(word) {
    var answer = '',
        a = {};
    // velika slova
    a['A'] = 'А';
    a['B'] = 'Б';
    a['V'] = 'В';
    a['G'] = 'Г';
    a['D'] = 'Д';
    a['Đ'] = 'Ђ';
    a['E'] = 'Е';
    a['Ž'] = 'Ж';
    a['Z'] = 'З';
    a['I'] = 'И';
    a['J'] = 'Ј';
    a['K'] = 'К';
    a['L'] = 'Л';
    a['W'] = 'Љ';
    a['M'] = 'М';
    a['N'] = 'Н';
    a['Nj'] = 'Њ';
    a['O'] = 'О';
    a['P'] = 'П';
    a['R'] = 'Р';
    a['S'] = 'С';
    a['T'] = 'Т';
    a['Ć'] = 'Ћ';
    a['U'] = 'У';
    a['F'] = 'Ф';
    a['H'] = 'Х';
    a['C'] = 'Ц';
    a['Č'] = 'Ч';
    a['Y'] = 'Џ';
    a['Š'] = 'Ш';

    // mala slova
    a['a'] = 'а';
    a['b'] = 'б';
    a['v'] = 'в';
    a['g'] = 'г';
    a['d'] = 'д';
    a['đ'] = 'ђ';
    a['e'] = 'е';
    a['ž'] = 'ж';
    a['z'] = 'з';
    a['i'] = 'и';
    a['j'] = 'ј';
    a['k'] = 'к';
    a['l'] = 'л';
    a['w'] = 'љ';
    a['m'] = 'м';
    a['n'] = 'н';
    a['nj'] = 'њ';
    a['o'] = 'о';
    a['p'] = 'п';
    a['r'] = 'р';
    a['s'] = 'с';
    a['t'] = 'т';
    a['ć'] = 'ћ';
    a['u'] = 'у';
    a['f'] = 'ф';
    a['h'] = 'х';
    a['c'] = 'ц';
    a['č'] = 'ч';
    a['y'] = 'џ';
    a['š'] = 'ш';

    for (i in word) {
        if (word.hasOwnProperty(i)) {
            word = word.replace(/nj/g, 'њ');
            word = word.replace(/Nj/g, 'Њ');
            word = word.replace(/NJ/g, 'Њ');
            word = word.replace(/Lj/g, 'Љ');
            word = word.replace(/LJ/g, 'Љ');
            word = word.replace(/lj/g, 'љ');
            word = word.replace(/Dž/g, 'Џ');
            word = word.replace(/DŽ/g, 'Џ');
            word = word.replace(/dž/g, 'џ');
            if (a[word[i]] === undefined) {
                answer += word[i];
            } else {
                answer += a[word[i]];
            }
        }
    }

    var romanTest = answer.split(' ');
    var index;

    for (index = 0; index < romanTest.length; ++index) {
        romanTest[index] = romanCheck(romanTest[index]);
    }

    answer = romanTest.join(' ');

    return answer;
}

/**
 * Funkcija za proveravanje rimskih brojeva
 * @param word
 * @returns {*}
 */
function romanCheck(word) {
    // return to latin
    var ans = cyrToLat(word);

    // pattern for roman numbers
    var patt = new RegExp('^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$');

    // test answer with pattern
    var res = patt.test(ans);

    // if it's true, return latin value
    if (res) {
        return ans;
    } else {
        // return original
        return word;
    }
}

/**
 * * Funkcija koristi latToCyr(), cyrToLat(), romanCheck(). Koristi se za latinično-ćiriličnu pretragu u jstree plugin-u. Kod inicijalizacije drveta porebno je
 * ubaciti u search pod search_callback funkcijom.
 *  Primer:
 * "search": {
 *     "show_only_matches" : true,
 *     "search_callback": function(searchString, node){
 *         if(filterNodeText(searchString , node)){
 *             return true;
 *         } else {
 *             return false;
 *         }
 *     },
 * },
 * @param {string} searchString
 * @param {object} node
 * @returns {boolean}
 */
function filterNodeText(searchString, node) {
    var value = searchString;
    var sadrzajLat = cyrToLat(value);
    var sadrzajCyr = latToCyr(value);

    var name = node.text;

    if (name.search(new RegExp(sadrzajLat, 'i')) > -1 || name.search(new RegExp(sadrzajCyr, 'i')) > -1) {
        return true;
    } else {
        return false;
    }
}

window.getQRCode = function(data, type, event) {
    let fileType = !data['fileType'] ? '' : data['fileType'];
    let uploadType = !data['uploadType'] ? '' : data['uploadType'];

    if (typeof event != 'undefined') {
        let allClasses = event.target.classList;

        if (allClasses.contains('mainFileDocument')) fileType = 'main';
        else if (allClasses.contains('anotherFormatDocument')) fileType = 'another';

        data['fileType'] = fileType;
    }

    $.ajax({
        type: 'POST',
        url: '/getQRCode',
        async: false,
        beforeSend: function() {
            $('#qrCode').html('');
            $('#qrCode').addClass('m-loader m-loader--success m-loader--center');
        },
        data: {
            data,
            type,
            fileType,
            uploadType,
        },
    }).done(function(msg) {
        $('#qrCode').html(msg);
        $('#qrCode').removeClass('m-loader m-loader--success m-loader--center');
    });
};

$(document).on('click', '#switch-principal-light-cb', function() {
    let checked = $(this).is(':checked');

    $.ajax({
        url: '/lightSwitch',
        method: 'POST',
        data: { check: checked },
    }).done(function(res) {
        let response = JSON.parse(res);

        if (response === true) {
            location.reload();
        }
    });
});

$(document).on('click', '#shareWithFirentsOpenModal', function() {
    $.ajax({
        url: '/getUserUniqueHash',
        method: 'GET',
    }).done(function(r) {
        const res = JSON.parse(r);
        $('#userUniqueHash').val(res.uniqueHash);
        $('#userUniqueData').val(JSON.stringify(res));
        $('#shareWithFirentsModal').modal();
    });
});

$('#openAdresarOfFriends').on('click', function() {
    $('#shareWithFirentsModalAdresar').modal();
});

function handleJSTranslations() {
    //Get localisation
    let locale = $('html').attr('lang');

    //Get translation json

    //return object or null if translation json is not found
}

/**
 * funkcija se koristi za moje i zajednicke dokumente - ukoliko korisnik osvezi stranicu da se vrati u isti folder
 * @param string folderID
 * @return void
 */
function setPageURL(folderID = 1) {
    let originalURL = window.location.href.split('?')[0];
    let newurl = originalURL + '?id=' + folderID;

    window.history.pushState({ path: newurl }, '', newurl);
}

/* Kadrovik start */

/* sprecava zatvaranje padajuceg menija */
$('.preventDefault').on('click', function(e) {
    e.preventDefault();
    e.stopPropagation();
});

/* otvara odgovarajuce inpute i cb(sadmin) */
function toggleChangeAccess(e) {
    let checked = $('#changeStringCb').prop('checked');
    toggleOtherContainers();
    $('#changeStringCb').prop('checked', !checked);
}

function toggleOtherContainers() {
    $('#accessStringContainer').slideUp('fast');

    if ($('#newStringContainer').css('display') == 'block') {
        $('#accessStringContainer').slideDown('fast');
        $('#newStringContainer').slideToggle('fast');
        $('#confrimStringContainer').slideToggle('fast');
        $('#submitStringContainer').slideToggle('fast');
    } else {
        $('#newStringContainer').slideToggle('fast');
        $('#confrimStringContainer').slideToggle('fast');
        $('#submitStringContainer').slideToggle('fast');
    }
    clearErrors();
}

/* sakriva sve elemente */
function hideAll() {
    $('#accessStringContainer').css('display', 'none');
    $('#changeStringContainer').css('display', 'none');
    $('#newStringContainer').css('display', 'none');
    $('#confrimStringContainer').css('display', 'none');
    $('#submitStringContainer').css('display', 'none');

    clearErrors();
}

/* brise crvene bordere, upozorenja i vrednosti input-a */
function clearErrors() {
    setBorderColor('accessStringInput', 'reset');
    setBorderColor('newStringInput', 'reset');
    setBorderColor('confirmStringInput', 'reset');

    $('#accessStringInputErr').hide();
    $('#newStringInputErr').hide();
    $('#confirmStringInputErr').hide();

    $('#accessStringInput').val('');
    $('#newStringInput').val('');
    $('#confirmStringInput').val('');
}

/* radi toggle za sva tri inputa */
var toggleCalendarPassView = false;
$('.togglePassText').on('click', function(e) {
    var selector = $(e.target).data('id');

    if ($('#' + selector).attr('type') == 'password') {
        toggleCalendarPassView = false;
    } else {
        toggleCalendarPassView = true;
    }

    toggleCalendarPassView = !toggleCalendarPassView;

    if (toggleCalendarPassView) {
        $('#' + selector).attr('type', 'text');
    } else {
        $('#' + selector).attr('type', 'password');
    }
});

function validateNewInput() {
    var newStringInput = $('#newStringInput').val();
    var confirmStringInput = $('#confirmStringInput').val();
    if (newStringInput == '') {
        setBorderColor('newStringInput', 'red');
        $('#newStringInputErr').show();
        return false;
    } else {
        setBorderColor('newStringInput', 'reset');
        $('#newStringInputErr').hide();
    }

    if (newStringInput === confirmStringInput) {
        setBorderColor('confirmStringInput', 'reset');
        $('#confirmStringInputErr').hide();
        return true;
    } else {
        setBorderColor('confirmStringInput', 'red');
        $('#confirmStringInputErr').show();
        return false;
    }
}

/* stavlja ili skida crveni border */
function setBorderColor(selector, color) {
    if (color == 'reset') {
        /* skida border */
        $('#' + selector)
            .parent()
            .css({ border: '', 'border-radius': '' });
        $('#' + selector).css({ 'border-radius': '' });
    } else {
        /* stavlja border */
        $('#' + selector)
            .parent()
            .css({ border: '1px solid ' + color, 'border-radius': '5px' });
        $('#' + selector).css({ 'border-radius': 'none' });
    }
}

$('#checkAccessStringSubmit').on('click', function() {
    if (validateCheckAccessString()) {
        var accessString = $('#accessStringInput').val();
        $.ajax({
            method: 'POST',
            url: '/kadrovik/checkAccessString',
            data: { accessString: accessString },
        }).done(function(response) {
            if (response == true) {
                window.location.reload();
            }
            /* ako logovanje nije uspesno za sada ne radimo apsolutno nista */
        });
    }
});

function validateCheckAccessString() {
    var string = $('#accessStringInput').val();
    if (string == '') {
        setBorderColor('accessStringInput', 'red');
        $('#accessStringInputErr').show();
        return false;
    } else {
        setBorderColor('accessStringInput', 'reset');
        $('#accessStringInputErr').hide();
        return true;
    }
}

/* Kadrovik end */

/* Zavodni pecat */
$('#zavodniPecat').on('click', function(event) {
    //init iz komponente
    event.preventDefault();
    window.zavodniPecatApp.$refs.zavodniPecatApp.init();
    $('#zavodniPecatModal').modal();
});
/* Zavodni pecat end */

/* Zatvaranje menija kada se pristupi podesavanjima preko button-a*/
var getURLSettings = window.location.toString();
var splitURLSettings = getURLSettings.split('?');

if (splitURLSettings[1] !== undefined && splitURLSettings[1].toString().includes('collapse')) {
    $('.sidebarAside li').removeClass('m-menu__item--open m-menu__item--expanded');
}

document.addEventListener('wheel', function(event) {
    if (document.activeElement.type === 'number' && document.activeElement.classList.contains('noscroll')) {
        document.activeElement.blur();
    }
});

function getAllUrlParams(url) {
    // get query string from url (optional) or window
    var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

    // we'll store the parameters here
    var obj = {};

    // if query string exists
    if (queryString) {
        // stuff after # is not part of query string, so get rid of it
        queryString = queryString.split('#')[0];

        // split our query string into its component parts
        var arr = queryString.split('&');

        for (var i = 0; i < arr.length; i++) {
            // separate the keys and the values
            var a = arr[i].split('=');

            // set parameter name and value (use 'true' if empty)
            var paramName = a[0];
            var paramValue = typeof a[1] === 'undefined' ? true : a[1];

            // (optional) keep case consistent
            paramName = paramName.toLowerCase();
            if (typeof paramValue === 'string') paramValue = paramValue.toLowerCase();

            // if the paramName ends with square brackets, e.g. colors[] or colors[2]
            if (paramName.match(/\[(\d+)?\]$/)) {
                // create key if it doesn't exist
                var key = paramName.replace(/\[(\d+)?\]/, '');
                if (!obj[key]) obj[key] = [];

                // if it's an indexed array e.g. colors[2]
                if (paramName.match(/\[\d+\]$/)) {
                    // get the index value and add the entry at the appropriate position
                    var index = /\[(\d+)\]/.exec(paramName)[1];
                    obj[key][index] = paramValue;
                } else {
                    // otherwise add the value to the end of the array
                    obj[key].push(paramValue);
                }
            } else {
                // we're dealing with a string
                if (!obj[paramName]) {
                    // if it doesn't exist, create property
                    obj[paramName] = paramValue;
                } else if (obj[paramName] && typeof obj[paramName] === 'string') {
                    // if property does exist and it's a string, convert it to an array
                    obj[paramName] = [obj[paramName]];
                    obj[paramName].push(paramValue);
                } else {
                    // otherwise add the property
                    obj[paramName].push(paramValue);
                }
            }
        }
    }

    return obj;
}

function _ispisFiltera(div, obj) {
    $(`#${div}`).empty();
    var ispis = `<p>`;
    for (const polje in obj) {
        var finalString = ``;
        mainPrevod = obj[polje].prevod;
        if (typeof obj[polje].vrednost === 'object' && !Array.isArray(obj[polje].vrednost)) {
            var poljeObjekat = obj[polje].vrednost;
            for (const objekat in poljeObjekat) {
                if (poljeObjekat[objekat].vrednost.length || poljeObjekat[objekat].vrednost === true) {
                    if (poljeObjekat[objekat].hasOwnProperty('prevod')) {
                        finalString += `${poljeObjekat[objekat].prevod} `;
                    }
                    if (Array.isArray(poljeObjekat[objekat].vrednost) === true) {
                        poljeObjekat[objekat].vrednost.map((item, i) => {
                            finalString += i < poljeObjekat[objekat].vrednost.length - 1 ? `${item}, ` : `${item}`;
                        });
                    } else {
                        finalString += `${poljeObjekat[objekat].vrednost} `;
                    }
                }
            }
        } else {
            if (obj[polje].vrednost.length || obj[polje].vrednost === true) {
                if (Array.isArray(obj[polje].vrednost) === true) {
                    obj[polje].vrednost.map((item, i) => {
                        finalString += i < obj[polje].vrednost.length - 1 ? `${item}, ` : `${item}`;
                    });
                } else {
                    finalString += `${obj[polje].vrednost} `;
                }
            }
        }

        ispis += finalString === '' ? '' : `<span class='badge badge-secondary font-weight-normal'><span class='font-weight-bold'>${mainPrevod}: </span> ${finalString}</span>`;
    }
    ispis += '</p>';
    $(`#${div}`).html(ispis);
}

// kada se više puta na datepicker on neće da se otvori
// rešenje je da se stavi klasa dtpfix na svaki datepicer u app
// i onda da se na svaki klik na to polje pokrene sledeće
$(document).on('click', '.dtpfix', function() {
    $(this)
        .removeClass('datepicker')
        .focus();
    return false;
});

$("#clikchangeuserrole").click(function(){
    $("#changeUserRole").modal();
});
/*
  Modifikovani chosen sa ajaxom (za subjektePravljen)

  chosenID - selektor select-a npr "#parent #selectID" (string)
  timeout_var - naziv varijable koja ce se koristiti za timeout (string)
  chosen_search_term - naziv varijable koja pamti korisnikov unos (string)
  initial_arr - inicijalni niz podataka koji ce se ispisivati odk ne krene sa ajaxom [izgleda da je Objekat sa propovima (0,1,2,3,4) a ne niz] (string) (u blade-u primer <script> window.clientSearchID_initial = {!! json_encode($allClients) !!};</script>)
*/
function chosenAjax_init(chosenID, chosen_search_term, initial_arr, timeout_var, timeout_delay = 1000) {
    // if (event.key === "Enter") {
    //   event.preventDefault(); // Spreči default ponašanje ENTER tastera
    // }

    if (typeof window[chosen_search_term] == 'undefined') {
        window[chosen_search_term] = '';
    }

    if (typeof window[timeout_var] == 'undefined') {
        window[timeout_var] = null;
    }

    if (typeof window[initial_arr] == 'undefined') {
        window[initial_arr] = {};
    }

    $(chosenID + '_chosen input').on('focus', function() {
        $(chosenID + '_chosen .chosen-search input').val(window[chosen_search_term]);
    });

    $(chosenID + '_chosen input').on('keyup', function() {
        clearTimeout(window[timeout_var]); //brise timeout ako se predomisli pre isteka delay-a

        let term = this.value;
        window[chosen_search_term] = term;

        if (term.length < 3) {
            $(chosenID).empty();
            $(chosenID).append('<option value=""> </option>');

            for (const prop in window[initial_arr]) {
                let subject = window[initial_arr][prop];
                var html =
                    '<option value="' +
                    subject.MM_ID +
                    '" data-jbkjs="' +
                    (subject.jbkjs ? subject.jbkjs : '') +
                    '" data-structure="' +
                    subject.ID +
                    '" data-type="' +
                    subject.Type +
                    '">' +
                    subject.SubjectName +
                    '</option>';
                $(chosenID).append(html);
            }

            $(chosenID).trigger('chosen:updated');
            $(chosenID + '_chosen .chosen-search input').val(term);
        } else {
            $(chosenID + '_chosen')
                .find('.chosen-results')
                .find('.no-results')
                .remove();
            window[timeout_var] = setTimeout(function() {
                $(chosenID + '_chosen .chosen-search input').prop('disabled', true);
                $(chosenID + '_chosen .chosen-search').append(`
                    <div class="chosen-search-loader">
                        <div class="m-loader m-loader--brand" style="width: 30px; display: inline-block;"></div>
                    </div>
                `);

                $.ajax({
                    url: '/selfAdmin/towho/list?term=' + term,
                    dataType: 'json',
                    method: 'GET',
                })
                    .done(function(res) {
                        var selected = $(chosenID).val() || 0;
                        $(chosenID + '_chosen .chosen-search input').prop('disabled', false);
                        $(chosenID).empty();
                        $(chosenID).append('<option value=""> </option>');

                        for (const prop in res) {
                            let subject = res[prop];
                            var html =
                                '<option value="' +
                                subject.MM_ID +
                                '" data-jbkjs="' +
                                (subject.jbkjs ? subject.jbkjs : '') +
                                '" data-structure="' +
                                subject.ID +
                                '" data-type="' +
                                subject.Type +
                                '">' +
                                subject.SubjectName +
                                '</option>';
                            $(chosenID).append(html);
                        }
                        $(chosenID)
                            .val(selected)
                            .trigger('chosen:updated');
                        if ((selected = 0)) {
                            $(chosenID).trigger('change');
                        }
                        $(chosenID + '_chosen .chosen-search input').val(term);
                        $(chosenID + '_chosen .chosen-search input')
                            .prop('disabled', false)
                            .trigger('focus');
                        $(chosenID + '_chosen .chosen-search .chosen-search-loader').remove();
                    })
                    .fail(function(err) {
                        $(chosenID + '_chosen .chosen-search input')
                            .prop('disabled', false)
                            .trigger('focus');
                        $(chosenID).empty();
                        $(chosenID).trigger('chosen:updated');
                        $(chosenID).trigger('change');
                        $(chosenID + '_chosen .chosen-search .chosen-search-loader').remove();
                    });
            }, timeout_delay);
        }
    });
}

function makeid(formID) {
    var result = '';
    var characters = [
        'a',
        'b',
        'c',
        'd',
        'e',
        'f',
        'g',
        'h',
        'i',
        'j',
        'k',
        'l',
        'm',
        'n',
        'o',
        'p',
        'q',
        'r',
        's',
        't',
        'u',
        'v',
        'w',
        'x',
        'y',
        'z',
        '0',
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
    ];
    var charactersLength = characters.length;
    for (var i = 0; i < 30; i++) {
        var randomIndex = Math.floor(Math.random() * charactersLength);
        result += characters[randomIndex];
    }
    return formID + result;
}
