function minPriceUpdate(vol) {
    $('#max-range-selector').attr('min', vol);
    document.querySelector('#min-price').value = vol;
}
function maxPriceUpdate(vol) {
    $('#min-range-selector').attr('max', vol);
    document.querySelector('#max-price').value = vol;
}
// Uncheck all specific categories
function allCategories() {
    $('#all_cat').change(function () {
        if (this.checked) {
            $('input:checkbox.category').prop('checked', false);
        }
    });
}
// Untoggle the "All" category
function specificCategories() {
    $('#all_cat').prop('checked', false);
}