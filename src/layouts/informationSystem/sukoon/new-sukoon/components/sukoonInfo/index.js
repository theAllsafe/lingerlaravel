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
  const [audio, setAudio] = useState("");
  const [image, setImage] = useState("");
  const [title, setTitle] = useState("");
  const userdata = JSON.parse(localStorage.getItem("user-info"));
  const [userid] = useState(userdata.id);
  const save = async () => {
    setIsLoading(true);
    const formDate = new FormData();
    formDate.append("audio", audio);
    formDate.append("userid", userid);
    formDate.append("image", image);
    formDate.append("title", title);
    // const item = { type, file };
    // console.log(formDate);
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/sukoon/store`, {
      method: "POST",
      body: formDate,
    });
    result = await result.json();
    setIsLoading(false);
    setErrorCode(result.code);
    if (result.code) {
      setErrorMessage(result.message);
    }
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
        <SuiTypography variant="h5">Sukoon</SuiTypography>
        <SuiBox mt={1}>
          <Grid container spacing={3}>
            <Grid item xs={6}>
              <SuiBox mb={1} ml={0.5} lineHeight={0} display="inline-block">
                <SuiTypography component="label" variant="caption" fontWeight="bold">
                  Audio&nbsp;
                </SuiTypography>
              </SuiBox>
              <br />
              <input type="file" onChange={(e) => setAudio(e.target.files[0])} />
            </Grid>
            <Grid item xs={6}>
              <SuiBox mb={1} ml={0.5} lineHeight={0} display="inline-block">
                <SuiTypography component="label" variant="caption" fontWeight="bold">
                  Image&nbsp;
                </SuiTypography>
              </SuiBox>
              <br />
              <input type="file" onChange={(e) => setImage(e.target.files[0])} />
            </Grid>
          </Grid>
        </SuiBox>
      </SuiBox>
      <SuiBox p={3}>
        <SuiBox mt={1}>
          <Grid container spacing={3}>
            <Grid item xs={12} sm={12}>
              <SuiBox mb={1} ml={0.5} lineHeight={0} display="inline-block">
                <SuiTypography component="label" variant="caption" fontWeight="bold">
                  Title&nbsp;
                </SuiTypography>
              </SuiBox>
              <SuiInput placeholder="Title..." onChange={(e) => setTitle(e.target.value)} />
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
