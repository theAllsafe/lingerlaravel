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

// react-router-dom components
import { Link } from "react-router-dom";

// @mui material components
import Grid from "@mui/material/Grid";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
import SuiButton from "components/SuiButton";

// Soft UI Dashboard PRO React example components
import DefaultNavbar from "examples/Navbars/DefaultNavbar";
import PageLayout from "examples/LayoutContainers/PageLayout";

// Soft UI Dashboard PRO React base styles
import typography from "assets/theme/base/typography";

// Authentication layout components
import Footer from "layouts/authentication/components/Footer";

// Soft UI Dashboard PRO React page layout routes
import pageRoutes from "pageRoutes";

// Images
import error500 from "assets/images/illustrations/error-500.png";

function Error500() {
  const { d1, d3, d4, d5 } = typography;

  return (
    <PageLayout white>
      <DefaultNavbar
        routes={pageRoutes}
        transparent
        action={{
          type: "external",
          route: "https://creative-tim.com/product/soft-ui-dashboard-pro-material-ui",
          label: "buy now",
          color: "dark",
        }}
      />
      <SuiBox my={18} height="calc(100vh - 18rem)">
        <Grid container spacing={3} justifyContent="center" alignItems="center" className="h-100">
          <Grid item xs={11} sm={9} container alignItems="center">
            <Grid item xs={12} lg={5}>
              <SuiBox
                fontSize={{ xs: d5.fontSize, sm: d4.fontSize, md: d3.fontSize, lg: d1.fontSize }}
                lineHeight={1.2}
              >
                <SuiTypography variant="inherit" textColor="warning" textGradient fontWeight="bold">
                  Error 500
                </SuiTypography>
              </SuiBox>
              <SuiTypography variant="h2" textColor="text" fontWeight="bold">
                Something went wrong
              </SuiTypography>
              <SuiBox mt={1} mb={2}>
                <SuiTypography variant="body1" textColor="text" opacity={0.6}>
                  We suggest you to go to the homepage while we solve this issue.
                </SuiTypography>
              </SuiBox>
              <SuiBox mt={4} mb={2}>
                <SuiButton component={Link} to="/" variant="gradient" buttonColor="warning">
                  go to homepage
                </SuiButton>
              </SuiBox>
            </Grid>
            <Grid item xs={12} lg={7}>
              <SuiBox component="img" src={error500} alt="error-404" width="100%" />
            </Grid>
          </Grid>
        </Grid>
      </SuiBox>
      <Footer />
    </PageLayout>
  );
}

export default Error500;
