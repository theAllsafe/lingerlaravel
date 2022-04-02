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
import EditInfo from "layouts/quizzManagement/season/edit-season/components/seasonInfo";

function EditProduct() {
  return (
    <DashboardLayout>
      <DashboardNavbar />
      <SuiBox my={3}>
        <Grid container spacing={3}>
          <Grid item xs={12} lg={12}>
            <EditInfo />
          </Grid>
        </Grid>
      </SuiBox>
      <Footer />
    </DashboardLayout>
  );
}

export default EditProduct;
