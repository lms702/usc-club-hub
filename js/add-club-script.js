$('#form').on('submit', function(){
    let errorDiv = $('#error');
    errorDiv.empty();
   // initial error checking
   if(!$('#name').val()){
       errorDiv.text('Please enter a club name!');
       return false;
   }
   else if(!$('#short_desc').val()){
       errorDiv.text('Please enter a short club description!');
       return false;
   }
   else if(!$('#long_desc').val()){
       errorDiv.text('Please enter a complete club description!');
       return false;
   }

});
