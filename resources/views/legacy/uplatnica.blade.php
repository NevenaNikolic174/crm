 <div class="body-uplatnica">
    <form class="uplatnica" method="POST" action="">
        <div class="form-group-uplatnica">
        <div class="form-left-uplatnica">
            <label for="uplatilac">Уплатилац
              <i class="fa fa-info-circle ml-1"
                data-toggle="m-tooltip"
                data-placement="bottom"
                title="Поље уплатилац може имати максимално 70 карактера."
                data-original-title="Поље уплатилац може имати максимално 70 карактера.">
              </i>
            </label>
            <textarea rows="3" id="uplatilac" required></textarea>

            <label for="svrha">Сврха уплате
              <i class="fa fa-info-circle ml-1"
                data-toggle="m-tooltip"
                data-placement="bottom"
                title="Поље сврха уплате може имати максимално 35 карактера."
                data-original-title="Поље сврха уплате може имати максимално 70 карактера.">
              </i>
            </label>
            <textarea rows="3" id="svrha" required></textarea>

            <label for="primalac">Прималац
              <i class="fa fa-info-circle ml-1"
                data-toggle="m-tooltip"
                data-placement="bottom"
                title="Поље прималац може имати максимално 70 карактера."
                data-original-title="Поље прималац може имати максимално 70 карактера.">
              </i>
            </label>
            <textarea rows="3" id="primalac" required></textarea>
        </div>

        <div class="form-right-uplatnica">
            <h2>НАЛОГ ЗА УПЛАТУ</h2>

            <div style="display: flex; gap: 15px; align-items: flex-end;">
                <div class="sifra" style="width: 55px">
                    <label for="sifra">Шифра плаћања</label>
                    <input type="text" id="sifra" maxlength="3">
                </div>

                <div class="valuta" style="width: 55px;">
                    <label for="valuta">Валута</label>
                    <input type="text" id="valuta" maxlength="3" value="RSD">
                </div>

                <div class="iznos" style="width: 100%;">
                    <label for="iznos">Износ</label>
                    <input class="" type="text" id="iznos" required>
                </div>
            </div>

            <div style="display: flex; gap: 15px; align-items: flex-end;">
                <div></div>
                <div class="racun" style="width: 355px; margin-left: 54px; margin-top: 11px;">
                    <label for="racun">Рачун примаоца</label>
                    <input type="text" id="racun" required>
                </div>

            </div>


            <div style="display: flex; gap: 15px; align-items: flex-end;">
                <div style="width: 55px;">
                    <label for="model">Број модела</label>
                    <input type="text" id="model" maxlength="2">
                </div>
                <div style="width: 100%;">
                    <label for="poziv">Позив на број (одобрење)</label>
                    <input type="text" id="poziv">
                </div>
            </div>
        </div>
        </div>

        <div class="potpis">
            <span>печат и потпис уплатиоца</span>
        </div>

        <button type="button" class="button-uplatnica" onclick="prikaziQRKodModalGenerate()">Generiši QR Kod</button>
    </form>
 </div>

<style>
    .body-uplatnica {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      padding: 20px;
    }

    .uplatnica {
      width: 900px;
      background: #e2e1e1;
      padding: 20px;
      margin: 0 auto;
      border-radius: 10px;
      box-shadow: 2px 2px 10px #aaa;
    }

    .uplatnica h2 {
      text-align: right;
      margin-top: 0;
    }

    .form-group-uplatnica {
      display: flex;
      margin-bottom: 10px;
    }

    .form-left-uplatnica {
        padding-top: 45px !important;
    }

    .form-left-uplatnica, .form-right-uplatnica {
      width: 50%;
      padding: 5px;
    }

    .form-left-uplatnica label, .form-right-upla.form-left-uplatnica label {
      display: block;
      font-size: 14px;
      margin-bottom: 4px;
    }

    .form-left-uplatnica input, .form-right-uplatnica input, .form-left-uplatnica textarea, .form-right-uplatnica textarea {
      width: 95%;
      padding: 6px;
      border: 1px solid #999;
      background-color: #ccd0e7;
    }

    .double-uplatnica {
      display: flex;
      justify-content: space-between;
    }

    .double-uplatnica input {
      width: 48%;
    }

    .potpis {
      margin-top: 20px;
      font-size: 12px;
      display: flex;
      justify-content: space-between;
    }

    .button-uplatnica {
      margin-top: 20px;
      padding: 10px 20px;
      background: #333;
      color: white;
      border: none;
      cursor: pointer;
    }
</style>

<script>

function prikaziQRKodModalGenerate(){
    $.ajax({
      type: 'GET',
      url: '/getQRCodeGenerateRecievedInvoicePaymentGenerated',
      async: false,
      data: {
        uplatilac : $("#uplatilac").val(),
        svrha: $("#svrha").val(),
        primalac: $("#primalac").val(),
        sifra: $("#sifra").val(),
        valuta: $("#valuta").val(),
        iznos: $("#iznos").val(),
        racun: $("#racun").val(),
        model: $("#model").val(),
        poziv: $("#poziv").val()
      },
      beforeSend: function () {
        $("#qrCodeImageGenerate").html("");
        $("#qrCodeImageGenerate").addClass("m-loader m-loader--success m-loader--center");
        $("#qrCodeErrorGenerate").html("");
      },
      success: function (response) {
        $("#qrCodeImageGenerate").removeClass("m-loader m-loader--success m-loader--center");
        $("#qrCodeImageGenerate").html(response);
    },
    error: function (xhr) {
        $("#qrCodeImageGenerate").removeClass("m-loader m-loader--success m-loader--center");
        let response = xhr.responseJSON;
        let currentValueMessage = response.curentValue ? 'Trenutna vrednost : '+response.curentValue : '';
        $("#qrCodeErrorGenerate").html('<span class="text-danger">' + response.message + '</span></br> <span class="text-danger"> ' + currentValueMessage + '</span>');
    }
    });
    // .done(function (data, response, error, xhr, msg) {
    //   console.log(data, response, error, xhr, msg);
    //   $("#qrCodeImage").html(msg);
    //   $("#qrCodeImage").removeClass("m-loader m-loader--success m-loader--center");
    // });
    document.getElementById("openModalSaveAsPaymentSlipTemplateBtn").style.display = "block";
    $("#qrCodeModalGenerate").modal();
  }

</script>

<script src="{{asset('legacy/assets/js/uplatnica.js')}}" type="text/javascript"></script>
