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
import Icon from "@mui/material/Icon";
import SuiAlert from "components/SuiAlert";
import SuiButton from "components/SuiButton";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
import SuiEditor from "components/SuiEditor";
// import SuiSelect from "components/SuiSelect";
// import SuiInput from "components/SuiInput";

function SlotInfo() {
  const [data, setDate] = useState([]);
  useEffect(async () => {
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/quizzinfo/`);
    result = await result.json();
    setDate(result);
  }, []);
  console.log(data);
  const [isLoading, setIsLoading] = useState(false);
  const [errorMessage, setErrorMessage] = useState("");
  const [errorcode, setErrorCode] = useState("");
  const [type] = useState("1");
  const [english, setEnglish] = useState("");
  const [hindi, setHindi] = useState("");
  const [roman, setRoman] = useState("");
  const [urdu, setUrdu] = useState("");
  const save = async () => {
    setIsLoading(true);
    const item = { type, english, hindi, roman, urdu };
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/quizzinfo/store`, {
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
    console.log(result);
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
        <SuiTypography variant="h5">Note</SuiTypography>
        <SuiBox mt={1}>
          <Grid container spacing={3}>
            <Grid item xs={6}>
              <SuiTypography variant="h6">ENGLISH</SuiTypography>
              <SuiEditor value={setEnglish} onChange={setEnglish} />
            </Grid>
            <Grid item xs={6}>
              <SuiTypography variant="h6">HINDI</SuiTypography>
              <SuiEditor value={setHindi} onChange={setHindi} />
            </Grid>
          </Grid>
        </SuiBox>
      </SuiBox>
      <SuiBox p={3}>
        <SuiBox mt={1}>
          <Grid container spacing={3}>
            <Grid item xs={6}>
              <SuiTypography variant="h6">ROMAN</SuiTypography>
              <SuiEditor value={setRoman} onChange={setRoman} />
            </Grid>
            <Grid item xs={6}>
              <SuiTypography variant="h6">URDU</SuiTypography>
              <SuiEditor value={setUrdu} onChange={setUrdu} />
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
