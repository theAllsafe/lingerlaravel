import { useState, useEffect } from "react";
// Soft UI Dashboard PRO React example components
// import TransparentInfoCard from "examples/Cards/InfoCards/TransparentInfoCard";
// import ComplexBackgroundCard from "examples/Cards/BackgroundCards/ComplexBackgroundCard";
// @mui material components
import Card from "@mui/material/Card";
import Grid from "@mui/material/Grid";
import Divider from "@mui/material/Divider";

import OutlinedCounterCard from "examples/Cards/CounterCards/OutlinedCounterCard";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";

// Soft UI Dashboard PRO React example components
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";
import { Table as MuiTable } from "@mui/material";
import TableBody from "@mui/material/TableBody";
import TableContainer from "@mui/material/TableContainer";
import TableRow from "@mui/material/TableRow";
// Data
// Data
import colors from "assets/theme/base/colors";
import typography from "assets/theme/base/typography";
import borders from "assets/theme/base/borders";

function DataTables() {
  const [columns] = useState([
    { name: "id", align: "center" },
    { name: "point", align: "center" },
    { name: "total time", align: "center" },
    { name: "name", align: "center" },
    { name: "mobile number", align: "center" },
    { name: "email", align: "center" },
  ]);

  const [rowname] = useState([
    { name: "id", align: "center" },
    { name: "point", align: "center" },
    { name: "total_time", align: "center" },
    { name: "name", align: "center" },
    { name: "mobile_no", align: "center" },
    { name: "email", align: "center" },
  ]);
  const { light } = colors;
  const { size, fontWeightBold } = typography;
  const { borderWidth } = borders;
  const [datadrop, setDateDrop] = useState([]);
  // const [isLoading, setIsLoading] = useState(false);

  const fetchProducts = async () => {
    // setIsLoading(true);
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/result/1`);
    result = await result.json();
    setDateDrop(result.data.result);
    // setIsLoading(false);
  };
  console.log(datadrop);
  useEffect(() => {
    fetchProducts();
  }, []);

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
        fontSize={size.xxc}
        fontWeight={fontWeightBold}
        opacity={0.9}
        borderBottom={`${borderWidth[2]} solid ${light.main}`}
      >
        {name.toUpperCase()}
      </SuiBox>
    );
  });

  const renderRows = datadrop.map((row, key) => {
    const rowKey = `row-${key}`;

    const tableRow = rowname.map(({ name, align }) => {
      let template;
      console.log(key);
      if (key !== 1 && key !== 2 && key !== 3) {
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
    <DashboardLayout>
      <DashboardNavbar />
      <SuiBox my={3}>
        <SuiBox mb={3}>
          <Card>
            <SuiBox p={2}>
              <SuiBox mb={1}>
                <SuiTypography variant="h5" fontWeight="medium">
                  TOP 3 TOPPER
                </SuiTypography>
              </SuiBox>
            </SuiBox>
            <SuiBox p={2}>
              <Grid container spacing={3}>
                <Grid item xs={6} lg={4}>
                  <OutlinedCounterCard count={1} title="Rohit Kumar" />
                </Grid>
                <Grid item xs={6} lg={4}>
                  <OutlinedCounterCard count={2} title="Rohit Kumar" />
                </Grid>
                <Grid item xs={6} lg={4}>
                  <OutlinedCounterCard count={3} title="Rohit Kumar" />
                </Grid>
              </Grid>
              <Divider />
            </SuiBox>
          </Card>
        </SuiBox>
      </SuiBox>
      <TableContainer>
        <MuiTable>
          <SuiBox component="thead">
            <TableRow>{renderColumns}</TableRow>
          </SuiBox>
          <TableBody>{renderRows}</TableBody>
        </MuiTable>
      </TableContainer>
      <Footer />
    </DashboardLayout>
  );
}

export default DataTables;
