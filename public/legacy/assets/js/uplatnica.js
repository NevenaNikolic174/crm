function openModalSaveAsPaymentSlipTemplate() {
  $("#savePaymentSlipTemplateModal").modal();
}

function saveAsPaymentSlipTemplate() {
  let templateName = $("#paymentSlipTemplateName").val();

  if (templateName.trim().length == 0) {
    alert("Popunite obavezna polja");
    return;
  }

  $.ajax({
    type: "POST",
    url: "/saveAsPaymentSlipTemplate",
    async: false,
    data: {
      uplatilac: $("#uplatilac").val(),
      svrha: $("#svrha").val(),
      primalac: $("#primalac").val(),
      sifra: $("#sifra").val(),
      valuta: $("#valuta").val(),
      iznos: $("#iznos").val(),
      racun: $("#racun").val(),
      model: $("#model").val(),
      poziv: $("#poziv").val(),
      templateName: $("#paymentSlipTemplateName").val(),
    },
    success: function(response) {
      swal({
        title: "",
        text: "Uspešno sačuvano",
        type: "success",
        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
        timer: 3000,
      });

      $("#savePaymentSlipTemplateModal").modal("hide");
      $("#paymentSlipTemplateName").val("");
    },
    error: function(xhr) {
      swal({
        title: "",
        text: "'Došlo je do grške",
        type: "success",
        confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
        timer: 3000,
      });
    },
  });
}

function openModalPaymentSlipList() {
  $("#paymentSlipListModal")
    .off("shown.bs.modal.paymentSlipInit")
    .on("shown.bs.modal.paymentSlipInit", function() {
      paymentSlipDatatable();
    });
  $("#paymentSlipListModal").modal();
}

function paymentSlipDatatable() {
  let table = $("#paymentSlipTable");

  table.DataTable({
    scrollX: true,
    responsive: false,
    processing: true,
    serverSide: true,
    destroy: true,
    ajax: {
      url: "/getPaymentSlipDatatable",
      type: "POST",
    },
    stateSave: false,
    autoWidth: false,
    order: [[0, "desc"]],
    aLengthMenu: [[10, 25, 50, 100, 1000000], [10, 25, 50, 100, "Svi"]],
    columnDefs: [
      { targets: 0, orderable: true },
      {
        targets: 1,
        orderable: false,
        render: function(data, type, row) {
          return `<button class="btn btn-success" onclick="openPaymentSlipQR(${
            data.id
          })">QR kod</button>`;
        },
      },
      {
        targets: 2,
        orderable: false,
        render: function(data, type, row) {
          return `<span class="dropdown">
                    <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" data-boundary="viewport" aria-expanded="false">
                    <i class="la la-ellipsis-v"></i>
                    </a>
                    <span class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" style="cursor: pointer;" onclick="deletePaymentSlipTemplate(${
                        data.id
                      })">
                          <i class="fa fa-trash"></i>
                          Obriši
                      </a>
                      <a class="dropdown-item sentToEmail" style="cursor: pointer;" onclick="sendToEmailModal(${
                        data.id
                      })">
                          <i class="fa fa-mail-forward"></i>
                          Pošalji na email
                      </a>
                    </span>
                  </span>`;
        },
      },
    ],
    columns: [{ data: "paymentSlipsName" }, { data: null }, { data: null }],
    language: {
      decimal: "",
      emptyTable: "Nema sačuvanih uplatnica",
      info: "Prikazuje se _START_ do _END_ od ukupno _TOTAL_ unosa",
      infoEmpty: "Prikazuje se 0 do 0 od ukupno 0 unosa",
      infoFiltered: "(filtrirano od ukupno _MAX_ unosa)",
      infoPostFix: "",
      thousands: ",",
      lengthMenu: "Prikazuje se _MENU_ unosa po stranici",
      loadingRecords: "Učitavanje...",
      processing: "Obrada...",
      search: "Pretraži:",
      zeroRecords: "Nema podataka koji odgovaraju pretraživanju",
      paginate: {
        first: "Prvi",
        last: "Posljednji",
        next: ">",
        previous: "<",
      },
      aria: {
        sortAscending: ": aktiviraj za sortiranje stupca uzlazno",
        sortDescending: ": aktiviraj za sortiranje stupca silazno",
      },
    },
  });
}

function openPaymentSlipQR(id) {
  $.ajax({
    type: "GET",
    url: "/getQRCodeGenerateFromTemplate",
    async: false,
    data: {
      id,
    },
    beforeSend: function() {
      $("#qrCodeImageGenerate").html("");
      $("#qrCodeImageGenerate").addClass(
        "m-loader m-loader--success m-loader--center"
      );
      $("#qrCodeErrorGenerate").html("");
    },
    success: function(response) {
      $("#qrCodeImageGenerate").removeClass(
        "m-loader m-loader--success m-loader--center"
      );
      $("#qrCodeImageGenerate").html(response);
    },
    error: function(xhr) {
      $("#qrCodeImageGenerate").removeClass(
        "m-loader m-loader--success m-loader--center"
      );
      let response = xhr.responseJSON;
      let currentValueMessage = response.curentValue
        ? "Trenutna vrednost : " + response.curentValue
        : "";
      $("#qrCodeErrorGenerate").html(
        '<span class="text-danger">' +
          response.message +
          '</span></br> <span class="text-danger"> ' +
          currentValueMessage +
          "</span>"
      );
    },
  });

  document.getElementById(
    "openModalSaveAsPaymentSlipTemplateBtn"
  ).style.display = "none";
  $("#paymentSlipListModal").modal("hide");
  $("#qrCodeModalGenerate").modal();
}

function deletePaymentSlipTemplate(id) {
  swal({
    title: "",
    text: "Da li ste sigurni da želite da obrišete uplatnicu?",
    type: "warning",
    confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
    showCancelButton: true,
    confirmButtonText: "Da",
    cancelButtonText: "Ne",
    closeOnCancel: true,
  }).then((result) => {
    if (result.value == true) {
      $.post("/deletePaymentSlipTemplate", {
        id: id,
      })
        .then(function(res) {
          swal({
            title: "",
            text: "Uspešno obrisano",
            type: "success",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
            timer: 3000,
          });
          paymentSlipDatatable();
        })
        .fail(function(err) {
          swal({
            title: "",
            text: "Došlo je do greške",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
          });
        });
    }
  });
}

function sendToEmailModal(id) {
    $("#qrId").val(id);
    $("#sendToEmailModal").modal();
}

function sendQRToEmail() {
    let email = $("#sendToEmail").val().trim();
    let qrId = $("#qrId").val();

    if(!email || email.length === 0) {
        swal({
            title: "",
            text: "Unesite obavezna polja",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
        });
        return
    }

    let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if(!emailRegex.test(email)) {
        swal({
            title: "",
            text: "Molimo vas unesite validnu email adresu.",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
        });
        return
    }

    if(!qrId || qrId.trim().length === 0) {
        console.log('Nema qr identifikator');
        swal({
            title: "",
            text: "Došlo je do greške",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
        });

        return;
    }

    $.post("/sendQrToEmail", {
        qrId,
        email
      })
        .then(function(res) {
            console.log(res);
        swal({
            title: "",
            text: "Uspešno poslato",
            type: "success",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
            timer: 3000,
          });
          $("#sendToEmail").val('');
          $("#sendToEmailModal").modal('hide');

        })
        .fail(function(err) {
            console.log(err)
          swal({
            title: "",
            text: "Došlo je do greške",
            type: "error",
            confirmButtonClass: "btn btn-secondary m-btn m-btn--wide",
          });
        });
}

document.addEventListener("DOMContentLoaded", function() {
  function limitInputLength(input, maxLength) {
        // Dok korisnik kuca
        input.addEventListener("input", function() {
            if (input.value.length > maxLength) {
                input.value = input.value.slice(0, maxLength);
            }
        });

        // Kada korisnik paste-uje tekst
        input.addEventListener("paste", function() {
            setTimeout(function() {
                if (input.value.length > maxLength) {
                    input.value = input.value.slice(0, maxLength);
                }
            }, 0);
        });
    }
    // Selektovanje polja
    const uplatilac = document.getElementById("uplatilac");
    const primalac = document.getElementById("primalac");
    const svrha = document.getElementById("svrha");

    // Ograničenja
    if(uplatilac) limitInputLength(uplatilac, 70);
    if(primalac) limitInputLength(primalac, 70);
    if(svrha) limitInputLength(svrha, 35);

});
