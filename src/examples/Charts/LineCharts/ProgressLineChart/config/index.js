/**
=========================================================
* Soft UI Dashboard PRO React - v2.0.0
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard-pro-material-ui
* Copyright 2021 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
*/

/* eslint-disable no-dupe-keys */
// Soft UI Dashboard PRO React helper functions
import rgba from "assets/theme/functions/rgba";

// Soft UI Dashboard PRO React base styles
import typography from "assets/theme/base/typography";
import colors from "assets/theme/base/colors";

const { gradients } = colors;

function configs(color, labels, label, data) {
  return {
    data: {
      labels,
      datasets: [
        {
          label,
          tension: 0.3,
          pointRadius: 2,
          pointBackgroundColor: gradients[color].main,
          borderColor: gradients[color].main,
          borderWidth: 2,
          backgroundColor: rgba(gradients[color].main, 0.1),
          maxBarThickness: 6,
          fill: true,
          data,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
      },
      interaction: {
        intersect: false,
        mode: "index",
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
          },
          ticks: {
            display: false,
            font: {
              family: typography.fontFamily,
            },
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: false,
            drawTicks: false,
          },
          ticks: {
            color: "#252f40",
            padding: 10,
            font: {
              family: typography.fontFamily,
            },
          },
        },
        y: {
          grid: {
            drawBorder: false,
            display: false,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
          },
          ticks: {
            display: true,
            padding: 10,
            color: "#9ca2b7",
            font: {
              family: typography.fontFamily,
            },
          },
        },
        x: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5],
          },
          ticks: {
            display: true,
            padding: 10,
            color: "#9ca2b7",
            font: {
              family: typography.fontFamily,
            },
          },
        },
      },
    },
  };
}

export default configs;
