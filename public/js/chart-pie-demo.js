// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

console.log(total_amount_conditions_key);
// Pie Chart Example

var ctx = document.getElementById("totalAmountPerCategory");
var myPieChart = new Chart( ctx, {
  type: 'doughnut',
  data: {
    labels: total_amount_categories_key,
    datasets: [{
      data: total_amount_categories_value,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#17a673', '#2e59d9'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});


var ctx1 = document.getElementById("totalAmountPerCondition");
var myPieChart = new Chart( ctx1, {
  type: 'doughnut',
  data: {
    labels: total_amount_conditions_key,
    datasets: [{
      data: total_amount_conditions_value,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#17a673'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
