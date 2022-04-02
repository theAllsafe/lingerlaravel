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
import Icon from "@mui/material/Icon";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
import SuiAvatar from "components/SuiAvatar";
import SuiButton from "components/SuiButton";

// Wizard application components
import FormField from "layouts/applications/wizard/components/FormField";

// Images
import team2 from "assets/images/team-2.jpg";

function About() {
  return (
    <SuiBox>
      <SuiBox width="80%" textAlign="center" mx="auto" mb={4}>
        <SuiBox mb={1}>
          <SuiTypography variant="h5" fontWeight="regular">
            Add Subscription
          </SuiTypography>
        </SuiBox>
      </SuiBox>
      <SuiBox mt={2}>
        <Grid container spacing={3}>
          <Grid item xs={12} sm={4} container justifyContent="center">
            <SuiBox position="relative" height="max-content" mx="auto">
              <SuiAvatar src={team2} alt="profile picture" size="xxl" variant="rounded" />
              <SuiBox alt="spotify logo" position="absolute" right={0} bottom={0} mr={-1} mb={-1}>
                <SuiButton variant="gradient" buttonColor="light" size="small" iconOnly>
                  <Icon className="">edit</Icon>
                </SuiButton>
              </SuiBox>
            </SuiBox>
          </Grid>
          <Grid item xs={12} sm={8}>
            <SuiBox mb={2}>
              <FormField type="text" label="first name" placeholder="Eg. Michael" />
            </SuiBox>
            <SuiBox mb={2}>
              <FormField type="text" label="last name" placeholder="Eg. Tomson" />
            </SuiBox>
            <SuiBox>
              <FormField type="text" label="email address" placeholder="Eg. soft@dashboard.com" />
            </SuiBox>
          </Grid>
        </Grid>
      </SuiBox>
    </SuiBox>
  );
}

export default About;
