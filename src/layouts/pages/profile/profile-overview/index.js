// @mui material components
import Grid from "@mui/material/Grid";
// import Card from "@mui/material/Card";
import { useState } from "react";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
// import SuiTypography from "components/SuiTypography";

// Soft UI Dashboard PRO React example components
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import Footer from "examples/Footer";
// import ProfileInfoCard from "examples/Cards/InfoCards/ProfileInfoCard";

// Overview page components
import Header from "layouts/pages/profile/components/Header";
// import PlatformSettings from "layouts/pages/profile/profile-overview/components/PlatformSettings";
import ChangePassword from "layouts/pages/account/security/components/ChangePassword";
import PasswordRequirements from "layouts/pages/account/security/components/PasswordRequirements";
// @mui material components
import Card from "@mui/material/Card";
// import Divider from "@mui/material/Divider";
import Tooltip from "@mui/material/Tooltip";
import Icon from "@mui/material/Icon";
import SuiTypography from "components/SuiTypography";

function Overview() {
  const userdata = JSON.parse(localStorage.getItem("user-info"));
  const [showText, setShowText] = useState(false);
  return (
    <DashboardLayout>
      <Header />
      <SuiBox mt={5} mb={3}>
        <Grid container spacing={3}>
          <Grid item xs={12} md={6} xl={6}>
            <Card className="h-100">
              <SuiBox
                display="flex"
                justifyContent="space-between"
                alignItems="center"
                pt={2}
                px={2}
              >
                <SuiTypography variant="h6" fontWeight="medium" textTransform="capitalize">
                  Profile Info
                </SuiTypography>
                <SuiTypography
                  variant="body2"
                  textColor="secondary"
                  onClick={() => setShowText(!showText)}
                >
                  <Tooltip placement="top">
                    <Icon className="">edit</Icon>
                  </Tooltip>
                </SuiTypography>
              </SuiBox>
              <SuiBox p={2}>
                <SuiBox>
                  <SuiBox display="flex" py={1} pr={2}>
                    <SuiTypography variant="button" fontWeight="bold" textTransform="capitalize">
                      fullName: &nbsp;{userdata.name}
                      <br />
                      mobile number: &nbsp;{userdata.email}
                      <br />
                      email: &nbsp;{userdata.email}
                      <br />
                      location: &nbsp;IND
                    </SuiTypography>
                  </SuiBox>
                </SuiBox>
              </SuiBox>
            </Card>
          </Grid>
          <Grid item xs={12} md={6} xl={6}>
            {showText && (
              <Grid container spacing={6}>
                <Grid item xs={12} md={12}>
                  <ChangePassword />
                </Grid>
              </Grid>
            )}
          </Grid>
        </Grid>
      </SuiBox>
      <SuiBox mb={3}>
        <Grid container spacing={3}>
          <Grid item xs={12} md={6}>
            <ChangePassword />
          </Grid>
          <Grid item xs={12} md={6}>
            <PasswordRequirements />
          </Grid>
        </Grid>
      </SuiBox>

      <Footer />
    </DashboardLayout>
  );
}

export default Overview;
