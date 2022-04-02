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

import { useState, useEffect } from "react";
import axios from "axios";
// @mui material components
import Card from "@mui/material/Card";
// import SuiButton from "components/SuiButton";
// @mui material components
import { Table as MuiTable } from "@mui/material";
import TableBody from "@mui/material/TableBody";
import TableContainer from "@mui/material/TableContainer";
import TableRow from "@mui/material/TableRow";
import Icon from "@mui/material/Icon";
import Tooltip from "@mui/material/Tooltip";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
// import SuiTypography from "components/SuiTypography";
// Soft UI Dashboard PRO React components
// import SuiAvatar from "components/SuiAvatar";
import SuiTypography from "components/SuiTypography";
// Soft UI Dashboard PRO React base styles
// import breakpoints from "assets/theme/base/breakpoints";

// Soft UI Dashboard PRO React example components
// import CameraView from "layouts/quizzManagement/hindi/questions-list/components/CameraView";
// Soft UI Dashboard PRO React base styles
import colors from "assets/theme/base/colors";
import typography from "assets/theme/base/typography";
import borders from "assets/theme/base/borders";
import Swal from "sweetalert2";

function Cameras() {
  const [columns] = useState([
    { name: "id", align: "center" },
    { name: "hindi", align: "center" },
    { name: "hindi_option_a", align: "center" },
    { name: "hindi_option_b", align: "center" },
    { name: "hindi_option_c", align: "center" },
    { name: "hindi_option_d", align: "center" },
    { name: "hindi_ans", align: "center" },
    { name: "Action", align: "left" },
  ]);
  const { light } = colors;
  const { size, fontWeightBold } = typography;
  const { borderWidth } = borders;
  const [datadrop, setDateDrop] = useState([]);
  // const [isLoading, setIsLoading] = useState(false);

  const fetchProducts = async () => {
    // setIsLoading(true);
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/question/`);
    result = await result.json();
    setDateDrop(result.data);
    // setIsLoading(false);
  };

  useEffect(() => {
    fetchProducts();
  }, []);
  // const [isLoading, setIsLoading] = useState(false);
  const deleteRow = async (id) => {
    const isConfirm = await Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    });
    if (!isConfirm) {
      return;
    }
    const result = await axios
      .delete(`${process.env.REACT_APP_DHEERAJ_KEY}admin/question/destroy/${id}`)
      .then(({ data }) => {
        Swal.fire({
          icon: "success",
          text: data.message,
        });
      })
      .catch(({ response: { data } }) => {
        Swal.fire({
          text: data.message,
          icon: "error",
        });
      });
    console.log(result);
  };
  const renderColumns = columns.map(({ name, align }, key) => {
    let pl;
    let pr;

    if (key === 0) {
      pl = 3;
      pr = 3;
    } else if (key === columns.length - 1) {
      pl = 3;
      pr = 3;
    } else {
      pl = 1;
      pr = 1;
    }

    return (
      <SuiBox
        key={name}
        component="th"
        pt={1.5}
        pb={1.25}
        pl={align === "left" ? pl : 3}
        pr={align === "right" ? pr : 3}
        textAlign={align}
        fontSize={size.xxs}
        fontWeight={fontWeightBold}
        color="secondary"
        opacity={0.7}
        borderBottom={`${borderWidth[1]} solid ${light.main}`}
      >
        {name.toUpperCase()}
      </SuiBox>
    );
  });

  const renderRows = datadrop.map((row, key) => {
    const rowKey = `row-${key}`;

    const tableRow = columns.map(({ name, align }) => {
      let template;
      if (row[name] === undefined) {
        template = (
          <SuiBox key={row[name]} component="td" p={1} textAlign={align}>
            <SuiBox display="flex" alignItems="center" py={0.5} px={1}>
              <SuiBox mr={2}>
                <Tooltip title="Edit product" placement="top">
                  <Icon className="" onClick={() => deleteRow(row.id)}>
                    edit
                  </Icon>
                </Tooltip>
              </SuiBox>
              <SuiBox mr={2}>
                <Tooltip title="Delete product" placement="top">
                  <Icon className="" onClick={() => deleteRow(row.id)}>
                    delete
                  </Icon>
                </Tooltip>
              </SuiBox>
            </SuiBox>
          </SuiBox>
        );
      } else {
        template = (
          <SuiBox key={row} component="td" p={1} textAlign={align}>
            <SuiTypography
              variant="button"
              fontWeight="regular"
              textColor="secondary"
              customClass="d-inline-block w-max"
            >
              <SuiBox mr={2}>{row[name]}</SuiBox>
            </SuiTypography>
          </SuiBox>
        );
      }

      return template;
    });

    return <TableRow key={rowKey}>{tableRow}</TableRow>;
  });
  return (
    <Card>
      <SuiBox display="flex" justifyContent="space-between" alignItems="center" pt={2} px={2}>
        <SuiBox display="flex" justifyContent="space-between" alignItems="center" width="100%">
          <SuiBox width="100%">
            <TableContainer>
              <MuiTable>
                <SuiBox component="thead">
                  <TableRow>{renderColumns}</TableRow>
                </SuiBox>
                <TableBody>{renderRows}</TableBody>
              </MuiTable>
            </TableContainer>
          </SuiBox>
        </SuiBox>
      </SuiBox>
    </Card>
  );
}

export default Cameras;
