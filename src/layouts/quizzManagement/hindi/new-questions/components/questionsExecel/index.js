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

// @mui material components
import Grid from "@mui/material/Grid";
import Card from "@mui/material/Card";
import SuiButton from "components/SuiButton";
import Icon from "@mui/material/Icon";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
// import SuiEditor from "components/SuiEditor";
// import SuiSelect from "components/SuiSelect";
import SuiAlert from "components/SuiAlert";
// import SuiDatePicker from "components/SuiDatePicker";
// import SuiInput from "components/SuiInput";
// NewProduct page components
// import FormField from "layouts/ecommerce/products/edit-product/components/FormField";

function ProductInfo() {
  const [isLoading, setIsLoading] = useState(false);
  const [errorMessage, setErrorMessage] = useState("");
  const [errorcode, setErrorCode] = useState("");
  const [seasonid, setSeason] = useState("1");
  const [file, setFile] = useState("");
  const save = async () => {
    setIsLoading(true);
    const formDate = new FormData();
    formDate.append("file", file);
    formDate.append("seasonid", seasonid);
    // const item = { type, file };
    // console.log(formDate);
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/question/storeExcel`, {
      method: "POST",
      body: formDate,
    });
    result = await result.json();
    setIsLoading(false);
    setErrorCode(result.code);
    if (result.code) {
      setErrorMessage(result.message);
    }
    // console.log(result);
    // history.push("/dashboards");
  };
  const [datadrop, setDateDrop] = useState([]);
  useEffect(async () => {
    setIsLoading(true);
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/question/season`);
    result = await result.json();
    setDateDrop(result.data);
    setIsLoading(false);
  }, []);
  return (
    <Card className="overflow-visible">
      {errorMessage && (
        <SuiAlert color={errorcode === 500 ? "error" : "success"}>
          <Icon className="material-icons-round" fonSize="small">
            thumb_up
          </Icon>
          <SuiTypography variant="body2" textColor="white">
            {errorMessage}
          </SuiTypography>
        </SuiAlert>
      )}
      <SuiBox p={3}>
        <SuiTypography variant="h5">Qusetion</SuiTypography>
        <SuiBox mt={1}>
          <Grid container spacing={3}>
            <Grid item xs={12} sm={12}>
              <SuiBox mb={1} ml={0.5} lineHeight={0} display="inline-block">
                <SuiTypography component="label" variant="caption" fontWeight="bold">
                  Season&nbsp;&nbsp;
                  <SuiTypography variant="caption" fontWeight="regular" textColor="text">
                    (optional)
                  </SuiTypography>
                </SuiTypography>
              </SuiBox>
              <select id="address">
                {datadrop &&
                  datadrop.length > 0 &&
                  datadrop.map((user) => <option value={user.id}>{user.season_name}</option>)}
                onChange = {setSeason}
              </select>
            </Grid>
          </Grid>
          <Grid container spacing={3}>
            <Grid item xs={12} sm={9}>
              <SuiBox>
                <SuiTypography variant="h5">Uploade Excel</SuiTypography>
                <SuiBox mt={3}>
                  <SuiBox mb={1} ml={0.5} lineHeight={0} display="inline-block">
                    <input type="file" onChange={(e) => setFile(e.target.files[0])} />
                  </SuiBox>
                </SuiBox>
              </SuiBox>
            </Grid>
          </Grid>
        </SuiBox>
      </SuiBox>
      <SuiBox mb={3}>
        <Grid container spacing={3} alignItems="center">
          <Grid item xs={12} lg={6}>
            <SuiBox display="flex" justifyContent="flex-end">
              {!isLoading ? (
                <SuiButton onClick={save} variant="gradient" buttonColor="info">
                  save
                </SuiButton>
              ) : (
                <SuiButton variant="gradient" buttonColor="warning">
                  Processing.....
                </SuiButton>
              )}
            </SuiBox>
          </Grid>
        </Grid>
      </SuiBox>
    </Card>
  );
}

export default ProductInfo;
