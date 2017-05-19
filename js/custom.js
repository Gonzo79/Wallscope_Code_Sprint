var tokenURL ='/token.php';
// Document Ready function
$(function(){
  $.getJSON(tokenURL,function(token){
    main(JSON.parse(token));
  })
});

function main(token){
  window.token = token;
  // Write your code here, token is the token object. token['access_token'] is the actual token
  $('#send-php').on('click',function(e){
    $.ajax({
      method: "POST",
      url: "/enhance.php?token="+window.token['access_token'],
      data: {        
        text: $('#text-to-send').val()  
      }
    })
    .done(function( data ) {
      window.data = JSON.parse(data);
      $('div#results').text(data)
    });
  });
}

function getMoreInfo(entity){
  $.ajax({
    method: "GET",
    url: "/entityhub.php?token="+window.token['access_token']+"&id="+entity
  })
  .done(function( data ) {
    window.entities = window.entities || [];
    window.entities.push(JSON.parse(data));
  });
}