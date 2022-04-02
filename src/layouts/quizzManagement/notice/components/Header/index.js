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
import Divider from "@mui/material/Divider";
import Icon from "@mui/material/Icon";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
// import SuiTypography from "components/SuiTypography";
// import SuiAvatar from "components/SuiAvatar";
import SuiButton from "components/SuiButton";

// Custom styles for the Header
// import styles from "layouts/applications/kanban/components/Header/styles";

// Image
// import team1 from "assets/images/team-1.jpg";
// import team2 from "assets/images/team-2.jpg";
// import team3 from "assets/images/team-3.jpg";
// import team4 from "assets/images/team-4.jpg";
// import team5 from "assets/images/team-5.jpg";

function Header() {
  // const classes = styles();

  return (
    <SuiBox display="flex" alignItems="center">
      <SuiBox height="75%" alignSelf="flex-end">
        <Divider orientation="vertical" />
      </SuiBox>
      <SuiBox pl={1}>
        <SuiButton variant="gradient" buttonColor="info" iconOnly>
          <Icon className=" font-bold">add</Icon>
        </SuiButton>
      </SuiBox>
    </SuiBox>
  );
}

export default Header;
