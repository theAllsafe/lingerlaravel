// @mui material components
import { useState, useEffect } from "react";
import Card from "@mui/material/Card";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";

// Soft UI Dashboard PRO React example components
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";
// import DataTable from "examples/Tables/DataTable";
// import Icon from "@mui/material/Icon";
// import SuiButton from "components/SuiButton";
// Data
// import dataTableData from "layouts/applications/Subscription/data/dataTableData";
import Table from "examples/Tables/Table";
// console.log(dataTableData);

export default function DataTables() {
  const [columns] = useState([
    { name: "id", align: "center" },
    { name: "type", align: "center" },
    { name: "title", align: "center" },
    { name: "price", align: "center" },
  ]);
  const [data, setDate] = useState([]);
  useEffect(async () => {
    let result = await fetch("http://localhost:8000/api/admin/subscription/");
    result = await result.json();
    setDate(result);
  }, []);
  // console.log(data.data);
  // const [rows] = useState([{ id: "asss", title: "asss" }]);
  // const [rows] = data;
  // console.log(rows);
  // const columns = data.data;
  return (
    <DashboardLayout>
      <DashboardNavbar />
      <SuiBox pt={6} pb={3}>
        <Card>
          <SuiBox p={3} lineHeight={1}>
            <SuiTypography variant="h5" fontWeight="medium">
              Subscription LIst
            </SuiTypography>
          </SuiBox>
          <Table columns={columns} rows={data.data} />
        </Card>
      </SuiBox>
      <Footer />
    </DashboardLayout>
  );
}
