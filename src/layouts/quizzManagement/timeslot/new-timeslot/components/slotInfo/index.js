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

import { useState, useLayoutEffect } from "react";

// @mui material components
import Grid from "@mui/material/Grid";
import Card from "@mui/material/Card";
import Icon from "@mui/material/Icon";
import SuiAlert from "components/SuiAlert";
import SuiButton from "components/SuiButton";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
// import SuiEditor from "components/SuiEditor";
// import SuiSelect from "components/SuiSelect";
import SuiInput from "components/SuiInput";
// NewProduct page components
// import FormField from "layouts/ecommerce/products/edit-product/components/FormField";

function SlotInfo() {
  const [isLoading, setIsLoading] = useState(false);
  useLayoutEffect(() => {
    window.scroll(0, 1000);
    return () => {};
  }, []);
  const [errorMessage, setErrorMessage] = useState("");
  const [errorcode, setErrorCode] = useState("");
  const [starttime, setStart] = useState("");
  const [endtime, setEnd] = useState("");
  const save = async () => {
    setIsLoading(true);
    const item = { starttime, endtime };
    let result = await fetch("http://localhost:8000/api/admin/timeslot/store", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify(item),
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
        <SuiTypography variant="h5">Time slot</SuiTypography>
        <SuiBox mt={1}>
          <Grid container spacing={3}>
            <Grid item xs={6}>
              <SuiInput onChange={(e) => setStart(e.target.value)} placeholder="Start time" />
            </Grid>
            <Grid item xs={6}>
              <SuiInput onChange={(e) => setEnd(e.target.value)} placeholder="End time" />
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

export default SlotInfo;
