$ = jQuery;
// Add a new repeating section
jQuery('.addBeneficiary').click(function(){
    console.log('beneficiary added');
    var lastRepeatingGroup = $('.repeatingSection').last();
    lastRepeatingGroup.clone().insertAfter(lastRepeatingGroup);
    return false;
});

// Delete a repeating section
$(document).on('click','.deleteBeneficiary',function(){
    console.log('beneficiary deleted');
$(this).parent('div').remove();
return false;
});

// destroy = function () {
//     // when the user clicks the "remove" link on a section...
//     $('.remove').click(function(){
//       // ...get that link's "repeatingSection" parent (container) and remove it
//       $(this).parent('.repeatingSection').remove();
//       // now, for each remaining repeatingSection element...
//       $('.repeatingSection').each(function(){
//         var r = this; // store "this", to avoid scope problems
//         var num = $(r).index() + 1; // store the index+1 of the current "repeatingSection" in the collection (zero-based indexes)
//         // RE-NUMBER ALL THE THINGS!!! >.<
//         // change the heading to reflect the index+1 value
//         $(r).children('h3').html('Beneficiary ' + num).text();
//         // go through all text box elements within...
//         $(r).find('input, textarea').each(function(){
//           // ...change their "structure" data attributes to reflect the index+1 value of the "repeatingSection" element
//           dattr = $(this).data('structure') + num;
//           $(this).attr({
//             'id':dattr,
//             'name':dattr
//           // update the "for" attribute on the parent element (label)
//           }).parent('label').attr('for',dattr);
//         });
//         //adjust the counter
//         $('#count').val($('.repeatingSection').length);
//       });
//       updateRemoveLinks();
//     });
//   }
//   destroy();

//    // when the user clicks the "add more" button...
//    $('.add_btn').click(function(){
//     var original = $('.repeatingSection').last().find(':checked');
//     console.log(original);
//     // clone the previous element (a "repeatingSection" element), and insert it before the "add more" button
//     $(this).prev('.repeatingSection').clone().insertBefore(this).html();
//     // get the number of repeatingSection elements on the page
//     var num = $('.repeatingSection').length;
//     // again, get the previous element (a "repeatingSection" element), and change the header to reflect it's new index
//     $(this).prev('.repeatingSection').children('h3').html('Person ' + num);
//     // now, go through all text boxes within the last "repeatingSection" element...
//     $('.repeatingSection').last().find('input, textarea').each(function(){
//       // ...change their "structure" data attributes to reflect the index+1 value of the "repeatingSection" element
//       dattr = $(this).data('structure') + num;
//       $(this).attr({
//         'id':dattr,
//         'name':dattr
//       // update the "for" attribute on the parent element (label)
//       }).parent('label').attr('for',dattr);
//       // clear the input field contents of the new "repeatingSection"
//       // if the type of the input is "radio"...
//       if ($(this).attr('type') == 'radio') {
//         // remove the checked attribute
//         $(this).removeAttr('checked');
//       // for all other inputs...
//       } else {
//         // clear the value...
//         $(this).val('');
//       }
//       if (original.length == 1) {
//           original.prop('checked',true);
//       }
//       //adjust the counter
//       $('#count').val($('.repeatingSection').length);
//     });
//     // run the "destroy" method... I forget why... just do it, and don't gimme no lip.
//     destroy();
//     updateRemoveLinks();
//   });

$(document).ready(function (){
    // insert an "add more" button after the last element
  $('#count').before('<input class="add_btn" id="add_btn" type="button" value="Add Person">');
  
  // add the "remove" link to each section
  $('.repeatingSection').prepend('<a class="remove" href="javascript:void(0);">[Remove]</a>');
  
  updateRemoveLinks = function () {
    // if "repeatingSection" element count is greater than 1...
    if ($('.repeatingSection').length > 1) {
      // ...show the "remove" link
      $('.repeatingSection').children('.remove').css({'display':'block'});
    // otherwise...
    } else {
      // don't display the "remove" link
      $('.repeatingSection').children('.remove').css({'display':'none'});
    }
  }
  
  updateRemoveLinks();

  // DESTROY!!! >.<
  // this method does all the checking necessary for deleting an element
  destroy = function () {
    // when the user clicks the "remove" link on a section...
    $('.remove').click(function(){
      // ...get that link's "repeatingSection" parent (container) and remove it
      $(this).parent('.repeatingSection').remove();
      // now, for each remaining repeatingSection element...
      $('.repeatingSection').each(function(){
        var r = this; // store "this", to avoid scope problems
        var num = $(r).index() + 1; // store the index+1 of the current "repeatingSection" in the collection (zero-based indexes)
        // RE-NUMBER ALL THE THINGS!!! >.<
        // change the heading to reflect the index+1 value
        $(r).children('h2').html('Person ' + num).text();
        // go through all text box elements within...
        $(r).find('input, textarea').each(function(){
          // ...change their "structure" data attributes to reflect the index+1 value of the "repeatingSection" element
          dattr = $(this).data('structure') + num;
          $(this).attr({
            'id':dattr,
            'name':dattr
          // update the "for" attribute on the parent element (label)
          }).parent('label').attr('for',dattr);
        });
        //adjust the counter
        $('#count').val($('.repeatingSection').length);
      });
      updateRemoveLinks();
    });
  }

  // now, call the "destroy" method, so that when the page loads, this method is declared and will affect all "repeatingSection" elements - this has something to do with adding/removing dynamic elements, I wrote this so long ago, that I don't recall exactly how it works...
  destroy();

  // when the user clicks the "add more" button...
  $('.add_btn').click(function(){
    var original = $('.repeatingSection').last().find(':checked');
    console.log(original);
    // clone the previous element (a "repeatingSection" element), and insert it before the "add more" button
    $(this).prev('.repeatingSection').clone().insertBefore(this).html();
    // get the number of repeatingSection elements on the page
    var num = $('.repeatingSection').length;
    // again, get the previous element (a "repeatingSection" element), and change the header to reflect it's new index
    $(this).prev('.repeatingSection').children('h2').html('Person ' + num);
    // now, go through all text boxes within the last "repeatingSection" element...
    $('.repeatingSection').last().find('input, textarea').each(function(){
      // ...change their "structure" data attributes to reflect the index+1 value of the "repeatingSection" element
      dattr = $(this).data('structure') + num;
      $(this).attr({
        'id':dattr,
        'name':dattr
      // update the "for" attribute on the parent element (label)
      }).parent('label').attr('for',dattr);
      // clear the input field contents of the new "repeatingSection"
      // if the type of the input is "radio"...
      if ($(this).attr('type') == 'radio') {
        // remove the checked attribute
        $(this).removeAttr('checked');
      // for all other inputs...
      } else {
        // clear the value...
        $(this).val('');
      }
      if (original.length == 1) {
          original.prop('checked',true);
      }
      //adjust the counter
      $('#count').val($('.repeatingSection').length);
    });
    // run the "destroy" method... I forget why... just do it, and don't gimme no lip.
    destroy();
    updateRemoveLinks();
  });
});
 
// $('#remainingbeneficiaries').is(':checked', function(){
//   $('#remainingbeneficiaries').attr('value', 'true');
// });

$("#remainingbeneficiaries").on('change', function() {
  if ($(this).is(':checked')) {
    $(this).attr('value', 'true');
  } else {
    $(this).attr('value', 'false');
  }
});
$('#cnic').keydown(function(){

    //allow  backspace, tab, ctrl+A, escape, carriage return
    if (event.keyCode == 8 || event.keyCode == 9 
                      || event.keyCode == 27 || event.keyCode == 13 
                      || (event.keyCode == 65 && event.ctrlKey === true) )
                          return;
    if((event.keyCode < 48 || event.keyCode > 57))
     event.preventDefault();
  
    var length = $(this).val().length; 
                
    if(length == 5 || length == 13)
     $(this).val($(this).val()+'-');
  
   });

//Using AJAX to submit the form
jQuery(document).ready(function($){
    jQuery('form#deliveryForm').on('submit', function(e){
       e.preventDefault();
       console.log('Ajax request triggered')
       var that = $(this),
       //url = that.attr('action'),
       type = that.attr('method');
       data = {};

       that.find('[name]').each(function(index,value){
           var that = $(this),
           name= that.attr('name'),
           value= that.val();

           data[name] = value;
       });
      console.log(data);

      //  $.ajax({
      //     url:'http://localhost/wordpress/wp-admin/admin-ajax.php',
      //     data: data,
      //     action: 'set_form_values',
      //     success: function(response){
      //       console.log("Data inserted !");
      //       console.log(response);
      //       $(".success_msg").css("display","block");
             
      //    }, error: function(data){
      //        $(".error_msg").css("display","block");
      //        console.log('Error! Data insertion failed');
      //        console.log(data);
      //              }
      //  });
       
    //$('.ajax')[0].reset();

    jQuery.post(
      'http://localhost/wordpress/wp-admin/admin-ajax.php', 
      {
          'action': 'set_form_values',
          'data':   data,
          success: function(response){
                  console.log("Data inserted !");
                  console.log(response);
                },

          error: function(data){
                  $(".error_msg").css("display","block");
                  console.log('Error! Data insertion failed');
                  console.log(data);
      }
    }
  );
    
      });
    });

$('form.ajax').on('submit', function(e){
    console.log('Trigger');


return false;
});