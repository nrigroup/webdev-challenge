// let y = [];
// let x = [];
// let z = [];
// let w = [];
// fetch("http://localhost:3000/dashboard/data")
//   .then((response) => {
//     if (!response.ok) {
//       throw new Error(`HTTP error: ${response.status}`);
//     }
//     console.log(response);

//     return response.text();
//   })
//   .then((text) => {
//     JSON.parse(text).forEach((element) => {
//       y.push(element.pre_tax_amount);
//       x.push(element.date);
//       z.push(element.category);
//       w.push(element.condition);
//     });
//     var ctx = document.getElementById("myChart").getContext("2d");
//     var chart = new Chart(ctx, {
//       type: "bar",
//       data: {
//         labels: x,
//         datasets: [
//           {
//             label: "",
//             data: y,
//             backgroundColor: "rgba(255, 99, 132, 0.2)",
//             borderColor: "rgba(255, 99, 132, 1)",
//             borderWidth: 1,
//           },
//         ],
//       },
//       options: {
//         scales: {
//           y: {
//             beginAtZero: true,
//           },
//         },
//       },
//     });
//     var ctx1 = document.getElementById("myChart1").getContext("2d");
//     var chart1 = new Chart(ctx1, {
//       type: "pie",
//       data: {
//         labels: w,
//         datasets: [
//           {
//             label: "# of Votes",
//             data: y,
//             backgroundColor: [
//               "rgba(255, 99, 132, 0.2)",
//               "rgba(54, 162, 235, 0.2)",
//               "rgba(255, 206, 86, 0.2)",
//               "rgba(75, 192, 192, 0.2)",
//               "rgba(153, 102, 255, 0.2)",
//               "rgba(255, 159, 64, 0.2)",
//             ],
//             borderColor: [
//               "rgba(255, 99, 132, 1)",
//               "rgba(54, 162, 235, 1)",
//               "rgba(255, 206, 86, 1)",
//               "rgba(75, 192, 192, 1)",
//               "rgba(153, 102, 255, 1)",
//               "rgba(255, 159, 64, 1)",
//             ],
//             borderWidth: 1,
//           },
//         ],
//       },
//     });
//     var ctx2 = document.getElementById("myChart2").getContext("2d");
//     var chart2 = new Chart(ctx2, {
//       type: "pie",
//       data: {
//         labels: z,
//         datasets: [
//           {
//             label: "# of Votes",
//             data: y,
//             backgroundColor: [
//               "rgba(255, 99, 132, 0.2)",
//               "rgba(54, 162, 235, 0.2)",
//               "rgba(255, 206, 86, 0.2)",
//               "rgba(75, 192, 192, 0.2)",
//               "rgba(153, 102, 255, 0.2)",
//               "rgba(255, 159, 64, 0.2)",
//             ],
//             borderColor: [
//               "rgba(255, 99, 132, 1)",
//               "rgba(54, 162, 235, 1)",
//               "rgba(255, 206, 86, 1)",
//               "rgba(75, 192, 192, 1)",
//               "rgba(153, 102, 255, 1)",
//               "rgba(255, 159, 64, 1)",
//             ],
//             borderWidth: 1,
//           },
//         ],
//       },
//     });
//   })

//   .catch((error) =>
//     console.log(
//       "There has been a problem with your fetch operation: " +
//         error.message +
//         error
//     )
//   );
