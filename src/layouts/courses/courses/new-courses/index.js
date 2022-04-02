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

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
// import SuiTypography from "components/SuiTypography";
// import SuiButton from "components/SuiButton";

// Soft UI Dashboard PRO React example components
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";

// EditProduct page components
import CoursesInfo from "layouts/courses/courses/new-courses/components/courses-Info";

function EditProduct() {
  return (
    <DashboardLayout>
      <DashboardNavbar />
      <SuiBox my={3}>
        <Grid container spacing={3}>
          <Grid item xs={12} lg={12}>
            <CoursesInfo />
          </Grid>
        </Grid>
      </SuiBox>
      <Footer />
    </DashboardLayout>
  );
}

export default EditProduct;
