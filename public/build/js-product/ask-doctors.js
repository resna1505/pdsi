/**
 * @name ask doctors
 * @function selected menu
 */

$('#case_categories li').click(function(){
  $('#case_categories li').removeClass('active');
  $(this).addClass('active');
});
