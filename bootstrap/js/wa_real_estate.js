jQuery(document).ready(function($){
$('#search_bds .header-main a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})

$('select.form-control.bfh-states[name="states"] > option:nth-child(1)').text('Tỉnh/Thành Phố');


})