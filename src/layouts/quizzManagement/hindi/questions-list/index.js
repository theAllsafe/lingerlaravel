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
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import Card from "@mui/material/Card";
import Stack from "@mui/material/Stack";
import Grid from "@mui/material/Grid";
import Cameras from "layouts/quizzManagement/hindi/questions-list/components/Cameras";
import SuiSelect from "components/SuiSelect";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
import SuiButton from "components/SuiButton";

// Soft UI Dashboard PRO React example components
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";
// import DataTable from "examples/Tables/DataTable";
// // Data
// import dataTableData from "layouts/quizzManagement/hindi/questions-list/data/dataTableData";

function ProductsList() {
  return (
    <DashboardLayout>
      <DashboardNavbar />
      <SuiBox my={3}>
        <Card>
          <SuiBox display="flex" justifyContent="space-between" alignItems="flex-start" p={3}>
            <SuiBox lineHeight={1}>
              <SuiTypography variant="h5" fontWeight="medium">
                All
              </SuiTypography>
            </SuiBox>
            <Stack spacing={1} direction="row">
              <Link to="/QuizzManagement/questions/AddQuestions" className="decoration-none">
                <SuiButton variant="gradient" buttonColor="info" size="small">
                  + New Questions
                </SuiButton>
              </Link>
            </Stack>
          </SuiBox>
          <SuiBox justifyContent="space-between" alignItems="flex-start" p={3}>
            <SuiSelect defaultValue={{ value: " ", label: "Select Season" }} />
          </SuiBox>
          <SuiBox mb={3}>
            <Grid container spacing={3}>
              <Grid item xs={12} xl={12}>
                <Cameras />
              </Grid>
            </Grid>
          </SuiBox>
        </Card>
      </SuiBox>
      <Footer />
    </DashboardLayout>
  );
}

export default ProductsList;
