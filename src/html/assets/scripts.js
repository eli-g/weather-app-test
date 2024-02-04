
async function getForecasts(date) {
  $.post( "/weather/getForecast", { date : date }, function( forecasts ) {
    for (const day in forecasts) {
      const friendlyDate = new Date(day);
      let hours = '';
      for (let i = 0; i < forecasts[day].length; i++) {
        hours += '<div class="hour"><h3>'+forecasts[day][i].time+'</h3><img src="/assets/svg/'+forecasts[day][i].forecast+'.svg" alt="'+forecasts[day][i].labels.english+'" title="'+forecasts[day][i].labels.english+'" /></div>'
      }
      $('#days').append('<h2 class="date">' + friendlyDate.toLocaleDateString('en-gb', {'dateStyle':'long'}) + '</h2>');
      $('#days').append('<div class="day" id="' + day + '">'+hours+'</div>');
    }
  }, "json");
}

$(window).on("load", function() {
  getForecasts("today");
});
