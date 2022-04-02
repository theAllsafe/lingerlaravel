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
// import SuiInput from "components/SuiInput";
// import SuiDropzone from "components/SuiDropzone";

function SlotInfo() {
  const [isLoading, setIsLoading] = useState(false);
  useLayoutEffect(() => {
    window.scroll(0, 1000);
    return () => {};
  }, []);
  const [errorMessage, setErrorMessage] = useState("");
  const [errorcode, setErrorCode] = useState("");
  const [type] = useState("1");
  const [file, setFile] = useState("");
  // const [starttime, setStart] = useState("");
  // const [endtime, setEnd] = useState("");
  // console.log(file);
  const save = async () => {
    setIsLoading(true);
    const formDate = new FormData();
    formDate.append("file", file);
    formDate.append("type", type);
    // const item = { type, file };
    // console.log(formDate);
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/homeSetting/store`, {
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
        <SuiBox>
          <SuiTypography variant="h5">Slider</SuiTypography>
          <SuiBox mt={3}>
            <SuiBox mb={1} ml={0.5} lineHeight={0} display="inline-block">
              <input type="file" onChange={(e) => setFile(e.target.files[0])} />
            </SuiBox>
          </SuiBox>
        </SuiBox>
      </SuiBox>
      <SuiBox mb={3} mt={11}>
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
