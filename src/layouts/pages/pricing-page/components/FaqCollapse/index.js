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

// prop-types is a library for typechecking of props
import PropTypes from "prop-types";

// @mui material components
import Icon from "@mui/material/Icon";
import Collapse from "@mui/material/Collapse";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";

// Soft UI Dashboard PRO React components
import borders from "assets/theme/base/borders";

function FaqCollapse({ title, open, children, ...rest }) {
  const { borderWidth, borderColor } = borders;

  return (
    <SuiBox mb={2}>
      <SuiBox
        {...rest}
        display="flex"
        justifyContent="space-between"
        alignItems="center"
        p={2}
        borderBottom={`${borderWidth[1]} solid ${borderColor}`}
        customClass="cursor-pointer"
      >
        <SuiTypography
          variant="h5"
          textColor={open ? "dark" : "text"}
          customClass="user-select-none"
        >
          {title}
        </SuiTypography>
        <SuiBox color={open ? "dark" : "text"}>
          <Icon className=" font-bold" fontSize="small">
            {open ? "remove" : "add"}
          </Icon>
        </SuiBox>
      </SuiBox>
      <Collapse timeout={400} in={open}>
        <SuiBox p={2} lineHeight={1}>
          <SuiTypography variant="button" textColor="text" opacity={0.8} fontWeight="regular">
            {children}
          </SuiTypography>
        </SuiBox>
      </Collapse>
    </SuiBox>
  );
}

// Typechecking props for the FaqCollapse
FaqCollapse.propTypes = {
  title: PropTypes.string.isRequired,
  open: PropTypes.bool.isRequired,
  children: PropTypes.node.isRequired,
};

export default FaqCollapse;
