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
import Fade from "@mui/material/Fade";
import Icon from "@mui/material/Icon";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
import SuiBadge from "components/SuiBadge";

import DataTable from "examples/Tables/DataTable";
// Data
import dataTableData from "layouts/quizzManagement/hindi/questions-list/data/dataTableData";
// Soft UI Dashboard PRO React base styles
import typography from "assets/theme/base/typography";

function CameraView({ date, time, value, index }) {
  const { size } = typography;

  return (
    value === index && (
      <Fade in timeout={850}>
        <SuiBox width="100%" height="100%" position="relative" borderRadius="lg">
          <DataTable
            table={dataTableData}
            entriesPerPage={{
              defaultValue: 7,
              entries: [5, 7, 10, 15, 20, 25],
            }}
            canSearch
          />
          <SuiBox
            display="flex"
            justifyContent="space-between"
            alignItems="center"
            position="absolute"
            top={0}
            left={0}
            width="calc(100% - 1rem)"
          >
            <SuiBox p={2}>
              <SuiTypography variant="h6" fontWeight="regular" textColor="white">
                {date} &nbsp; {time}
              </SuiTypography>
            </SuiBox>
            <SuiBadge
              color="secondary"
              variant="contained"
              badgeContent={
                <SuiBox display="flex" alignItems="center">
                  <SuiBox color="error" lineHeight={0} fontSize={size.regular}>
                    <Icon>fiber_manual_record</Icon>
                  </SuiBox>
                  <SuiBox mb={-0.25} ml={0.25}>
                    <SuiTypography
                      component="span"
                      variant="caption"
                      textColor="text"
                      fontWeight="bold"
                      textTransform="uppercase"
                    >
                      recording
                    </SuiTypography>
                  </SuiBox>
                </SuiBox>
              }
            />
          </SuiBox>
        </SuiBox>
      </Fade>
    )
  );
}

// Typechecking props for the CameraView
CameraView.propTypes = {
  // image: PropTypes.string.isRequired,
  date: PropTypes.string.isRequired,
  time: PropTypes.string.isRequired,
  value: PropTypes.oneOfType([PropTypes.string, PropTypes.number]).isRequired,
  index: PropTypes.oneOfType([PropTypes.string, PropTypes.number]).isRequired,
};

export default CameraView;
