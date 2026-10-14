const d={despatchSent:"eOtpremnice.filters.despatch.sent",despatchReceived:"eOtpremnice.filters.despatch.received",despatchAssigned:"eOtpremnice.filters.despatch.assigned",receiptSent:"eOtpremnice.filters.receipt.sent",receiptReceived:"eOtpremnice.filters.receipt.received",nonSeoDespatchSent:"eOtpremnice.filters.despatch.nonSeoSent",despatchDraft:"eOtpremnice.filters.despatch.draft",receiptDraft:"eOtpremnice.filters.receipt.draft",nonSeoDespatchDraft:"eOtpremnice.filters.despatch.nonSeoDraft"},u=Object.values(d),f="Zapamćeni filteri ostaju aktivni dok se ne izlogujete ili dok ne promenite neki parametar u filterima.";function l(e){try{const t=localStorage.getItem(e);return t?JSON.parse(t):null}catch{return null}}function m(e,t){try{localStorage.setItem(e,JSON.stringify(t))}catch{}}function n(e){try{localStorage.removeItem(e)}catch{}}function S(){u.forEach(n)}const v={KEYS:d,buildButtonsHtml(){return`
            <div class="form-group col-md-auto saveFiltersWrap" style="display:none; margin-left: -90px;">
                <label class="col-form-label">&nbsp;</label><br>
                <div class="d-flex align-items-center">
                    <button type="button" id="saveFilters" class="btn btn-primary m-btn">
                        <i class="la la-save"></i> Zapamti filtere
                    </button>
                    <span class="ml-2" style="cursor: help;"
                          data-toggle="tooltip" data-placement="top"
                          title="${f}">
                        <i class="la la-info-circle" style="font-size:18px; color:#716aca;"></i>
                    </span>
                </div>
            </div>
            <div class="form-group col-md-auto deleteFiltersWrap" style="display:none; margin-left: -90px;">
                <label class="col-form-label">&nbsp;</label><br>
                <div class="d-flex align-items-center">
                    <button type="button" id="deleteFilters" class="btn btn-warning m-btn">
                        <i class="la la-eraser"></i> Obriši filtere
                    </button>
                    <span class="ml-2" style="cursor: help;"
                          data-toggle="tooltip" data-placement="top"
                          title="${f}">
                        <i class="la la-info-circle" style="font-size:18px; color:#716aca;"></i>
                    </span>
                </div>
            </div>
        `},load(e){return l(e)},save(e,t,i){m(e,i),this.toggleButtons(t,!0),window.swal&&window.swal({text:"Filteri su zapamćeni.",type:"success",confirmButtonText:"Zatvori",timer:1500})},remove(e){n(e)},toggleButtons(e,t){const i=jQuery(e);t?(i.find(".saveFiltersWrap").hide(),i.find(".deleteFiltersWrap").show()):(i.find(".saveFiltersWrap").show(),i.find(".deleteFiltersWrap").hide())},refreshButtonsState(e,t){this.toggleButtons(e,!!l(t))},clearIfSaved(e,t){l(e)&&(n(e),this.toggleButtons(t,!1))},attachHandlers(e,t,i,r={}){const o=jQuery,c=r.changeSelectors||'select, input[type="text"]:not(.chosen-search-input)',s=r.inputSelector||"#despatchAddress",a=o(e),p=this;a.off("change.eotpFilterSave",c).on("change.eotpFilterSave",c,function(){p.clearIfSaved(t,e)}),s&&a.off("input.eotpFilterSave",s).on("input.eotpFilterSave",s,function(){p.clearIfSaved(t,e)}),a.off("click.eotpFilterSave","#saveFilters, #deleteFilters").on("click.eotpFilterSave","#saveFilters",function(){typeof i.saveCurrentFilters=="function"&&i.saveCurrentFilters()}).on("click.eotpFilterSave","#deleteFilters",function(){typeof i.deleteSavedFilters=="function"&&i.deleteSavedFilters()}),o.fn.tooltip&&a.find('[data-toggle="tooltip"]').tooltip()}},h=v;export{d as F,h as _,S as c};
