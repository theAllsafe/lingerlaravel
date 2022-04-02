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
import ProductInfo from "layouts/quizzManagement/hindi/new-questions/components/questionsInfo";
import QuestionExcel from "layouts/quizzManagement/hindi/new-questions/components/questionsExecel";
import Verification from "layouts/quizzManagement/hindi/new-questions/components/verification-Info";

function EditProduct() {
  const status = localStorage.getItem("question-verification-status") === "true";
  // const status = rememberMe ? localStorage.getItem("question-verification-status") : "";
  // // this.setState({ user, rememberMe });
  // console.log("rememberMe");
  console.log(status);

  // const status = "";
  // if (localStorage.getItem("question-verification-status")) {
  //   status = JSON.parse(localStorage.getItem("question-verification-status"));
  // }
  return (
    <DashboardLayout>
      <DashboardNavbar />
      {status === false ? (
        " "
      ) : (
        <SuiBox my={3}>
          <Grid container justifyContent="center" className="h-100" spacing={3}>
            <Grid item xs={4} lg={4}>
              <Verification />
            </Grid>
          </Grid>
        </SuiBox>
      )}
      {status === true ? (
        " "
      ) : (
        <SuiBox my={3}>
          <Grid container spacing={3}>
            <Grid item xs={12} lg={12}>
              <ProductInfo />
            </Grid>
            <Grid item xs={12} lg={12}>
              <QuestionExcel />
            </Grid>
          </Grid>
        </SuiBox>
      )}
      <Footer />
    </DashboardLayout>
  );
}

export default EditProduct;
