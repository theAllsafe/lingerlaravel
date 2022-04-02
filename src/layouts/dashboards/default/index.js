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

// @mui material components
import Grid from "@mui/material/Grid";
// import Icon from "@mui/material/Icon";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
// import SuiTypography from "components/SuiTypography";

// Soft UI Dashboard PRO React example components
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";
import MiniStatisticsCard from "examples/Cards/StatisticsCards/MiniStatisticsCard";
import SalesTable from "examples/Tables/SalesTable";
// import ReportsBarChart from "examples/Charts/BarCharts/ReportsBarChart";
// import GradientLineChart from "examples/Charts/LineCharts/GradientLineChart";
import Globe from "examples/Globe";

// Soft UI Dashboard PRO React base styles
// import typography from "assets/theme/base/typography";
// import breakpoints from "assets/theme/base/breakpoints";

// Data
import salesTableData from "layouts/dashboards/default/data/salesTableData";
// import reportsBarChartData from "layouts/dashboards/default/data/reportsBarChartData";
// import gradientLineChartData from "layouts/dashboards/default/data/gradientLineChartData";

function Default() {
  // const { values } = breakpoints;
  // const { size } = typography;
  // const { chart, items } = reportsBarChartData;

  return (
    <DashboardLayout>
      <DashboardNavbar />
      <SuiBox py={3}>
        <Grid container>
          <Grid item xs={12} lg={7}>
            <Grid container>
              <Grid item xs={12}>
                <Globe
                  display={{ xs: "none", md: "block" }}
                  position="absolute"
                  top="10%"
                  right={0}
                  mt={{ xs: -12, lg: 1 }}
                  mr={{ xs: 0, lg: 10 }}
                  canvasStyle={{ marginTop: "3rem" }}
                />
              </Grid>
            </Grid>

            <Grid container spacing={3}>
              <Grid item xs={12} sm={5}>
                <SuiBox mb={3}>
                  <MiniStatisticsCard
                    title={{ text: "All Users" }}
                    count="53,000"
                    percentage={{ color: "success", text: "" }}
                    icon={{ color: "info", component: "public" }}
                  />
                </SuiBox>
                <MiniStatisticsCard
                  title={{ text: "today's users" }}
                  count="2,300"
                  percentage={{ color: "success", text: "" }}
                  icon={{ color: "info", component: "public" }}
                />
              </Grid>
              <Grid item xs={12} sm={5}>
                <SuiBox mb={3}>
                  <MiniStatisticsCard
                    title={{ text: "Season users" }}
                    count="3,462"
                    percentage={{ color: "error", text: "" }}
                    icon={{ color: "info", component: "public" }}
                  />
                </SuiBox>
                <SuiBox mb={3}>
                  <MiniStatisticsCard
                    title={{ text: "Weekly users" }}
                    count="103,430"
                    percentage={{ color: "success", text: "" }}
                    icon={{
                      color: "info",
                      component: "public",
                    }}
                  />
                </SuiBox>
              </Grid>
            </Grid>
          </Grid>
          <Grid item xs={12} md={10} lg={7}>
            <Grid item xs={12} lg={10}>
              <SuiBox mb={3} position="relative">
                <SalesTable title="Top Winners List" rows={salesTableData} />
              </SuiBox>
            </Grid>
          </Grid>
        </Grid>
      </SuiBox>
      <Footer />
    </DashboardLayout>
  );
}

export default Default;
