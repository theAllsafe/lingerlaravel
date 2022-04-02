import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import axios from "axios";
// @mui material components
import Card from "@mui/material/Card";
import Stack from "@mui/material/Stack";
// import SuiAvatar from "components/SuiAvatar";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
import SuiButton from "components/SuiButton";
import { Table as MuiTable } from "@mui/material";
import TableBody from "@mui/material/TableBody";
import TableContainer from "@mui/material/TableContainer";
import TableRow from "@mui/material/TableRow";
import Icon from "@mui/material/Icon";
import Tooltip from "@mui/material/Tooltip";
// Soft UI Dashboard PRO React example components
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";
// Data
import colors from "assets/theme/base/colors";
import typography from "assets/theme/base/typography";
import borders from "assets/theme/base/borders";
import Swal from "sweetalert2";
import SuiAvatar from "components/SuiAvatar";

function ProductsList() {
  const [columns] = useState([
    { name: "id", align: "center" },
    { name: "image", align: "left" },
    { name: "title", align: "center" },
    { name: "description", align: "center" },
    { name: "Action", align: "left" },
  ]);
  const [rowname] = useState([
    { name: "id", align: "center" },
    { name: "image", align: "center" },
    { name: "title", align: "center" },
    { name: "description", align: "center" },
    { name: "Action", align: "left" },
  ]);
  const { light } = colors;
  const { size, fontWeightBold } = typography;
  const { borderWidth } = borders;
  const [datadrop, setDateDrop] = useState([]);
  // const [isLoading, setIsLoading] = useState(false);

  const fetchProducts = async () => {
    // setIsLoading(true);
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/course/`);
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
      .delete(`${process.env.REACT_APP_DHEERAJ_KEY}admin/course/destroy/${id}`)
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
    console.log(result + id);
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

    const tableRow = rowname.map(({ name, align }) => {
      let template;
      if (row[name] === undefined) {
        template = (
          <SuiBox key={row[name]} component="td" p={1} textAlign={align}>
            <SuiBox display="flex" alignItems="center" py={0.5} px={1}>
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
      } else if (name === "image") {
        template = (
          <SuiBox key={row[name]} component="td" p={1} textAlign={align}>
            <SuiBox display="flex" alignItems="center" py={0.5} px={1}>
              <SuiBox mr={2}>
                <SuiAvatar
                  src={row.image}
                  alt="profile-image"
                  variant="rounded"
                  size="xl"
                  customClass="shadow-sm"
                />
              </SuiBox>
            </SuiBox>
          </SuiBox>
        );
      } else if (name === "icon") {
        template = (
          <SuiBox key={row[name]} component="td" p={1} textAlign={align}>
            <SuiBox display="flex" alignItems="center" py={0.5} px={1}>
              <SuiBox mr={2}>
                <SuiAvatar
                  src={row.icon}
                  alt="profile-image"
                  variant="rounded"
                  size="xl"
                  customClass="shadow-sm"
                />
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
    <DashboardLayout>
      <DashboardNavbar />
      <SuiBox my={3}>
        <Card>
          <SuiBox display="flex" justifyContent="space-between" alignItems="flex-start" p={3}>
            <SuiBox lineHeight={1}>
              <SuiTypography variant="h5" fontWeight="medium">
                Dua Wazifa
              </SuiTypography>
            </SuiBox>
            <Stack spacing={1} direction="row">
              <Link to="/Profile/Dua&Wazifa/addDuaWazifa" className="decoration-none">
                <SuiButton variant="gradient" buttonColor="info" size="small">
                  + Add new Dua Wazifa
                </SuiButton>
              </Link>
            </Stack>
          </SuiBox>
          <TableContainer>
            <MuiTable>
              <SuiBox component="thead">
                <TableRow>{renderColumns}</TableRow>
              </SuiBox>
              <TableBody>{renderRows}</TableBody>
            </MuiTable>
          </TableContainer>
        </Card>
      </SuiBox>
      <Footer />
    </DashboardLayout>
  );
}

export default ProductsList;
