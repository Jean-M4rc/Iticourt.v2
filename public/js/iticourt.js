$('#getCoordonates').click(function(){
    if(navigator.geolocation) {
        // L'API est disponible
        
        navigator.geolocation.getCurrentPosition(maPosition);

      } else {
        // Pas de support, proposer une alternative ?
      }
});

function maPosition(position) {

    $('#longInput').val(position.coords.longitude);
    $('#latInput').val(position.coords.latitude);
    
}
  