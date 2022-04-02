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
import SuiSelect from "components/SuiSelect";
import SuiAlert from "components/SuiAlert";
// import SuiDatePicker from "components/SuiDatePicker";
import SuiInput from "components/SuiInput";
// NewProduct page components
// import FormField from "layouts/ecommerce/products/edit-product/components/FormField";
// import { animation } from "components/SuiSelect/styles";

function ProductInfo() {
  // const classes = animation();
  // const [data, setDate] = useState([]);
  // useEffect(async () => {
  //   let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/quizzinfo/`);
  //   result = await result.json();
  //   setDate(result);
  // }, []);
  // console.log(data);
  const [isLoading, setIsLoading] = useState(false);
  const [errorMessage, setErrorMessage] = useState("");
  const [errorcode, setErrorCode] = useState("");
  const [season, setSeason] = useState();
  const [english, setEnglish] = useState("");
  const [englishoptiona, setEnglishoptiona] = useState("");
  const [englishoptionb, setEnglishoptionb] = useState("");
  const [englishoptionc, setEnglishoptionc] = useState("");
  const [englishoptiond, setEnglishoptiond] = useState("");
  const [englishans, setEnglishans] = useState("");
  // hindi
  const [hindi, setHindi] = useState("");
  const [hindioptiona, setHindioptiona] = useState("");
  const [hindioptionb, setHindioptionb] = useState("");
  const [hindioptionc, setHindioptionc] = useState("");
  const [hindioptiond, setHindioptiond] = useState("");
  const [hindians, setHindians] = useState("");
  // roman
  const [roman, setRoman] = useState("");
  const [romanoptiona, setRomanoptiona] = useState("");
  const [romanoptionb, setRomanoptionb] = useState("");
  const [romanoptionc, setRomanoptionc] = useState("");
  const [romanoptiond, setRomanoptiond] = useState("");
  const [romanans, setRomanans] = useState("");
  // urdu
  const [urdu, setUrdu] = useState("");
  const [urduoptiona, setUrduoptiona] = useState("");
  const [urduoptionb, setUrduoptionb] = useState("");
  const [urduoptionc, setUrduoptionc] = useState("");
  const [urduoptiond, setUrduoptiond] = useState("");
  const [urduans, setUrduans] = useState("");
  const save = async () => {
    setIsLoading(true);
    const item = {
      season,
      english,
      englishoptiona,
      englishoptionb,
      englishoptionc,
      englishoptiond,
      englishans,
      hindi,
      hindioptiona,
      hindioptionb,
      hindioptionc,
      hindioptiond,
      hindians,
      roman,
      romanoptiona,
      romanoptionb,
      romanoptionc,
      romanoptiond,
      romanans,
      urdu,
      urduoptiona,
      urduoptionb,
      urduoptionc,
      urduoptiond,
      urduans,
    };
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin/question/store`, {
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
    if (result.code === 200) {
      setEnglish("");
      // alert(result.code);
    }
    console.log(result.code);
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
              <SuiSelect
                onChange={setSeason}
                defaultValue={{ value: " ", label: "Select Season" }}
                options={datadrop}
              />
            </Grid>
          </Grid>
          <br />
          <Grid container spacing={3}>
            <Grid item xs={12} sm={9}>
              <SuiInput
                placeholder="English Question"
                onChange={(e) => setEnglish(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput
                placeholder="English Answer"
                onChange={(e) => setEnglishans(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput
                placeholder="Option A"
                onChange={(e) => setEnglishoptiona(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput
                placeholder="Option B"
                onChange={(e) => setEnglishoptionb(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput
                placeholder="Option C"
                onChange={(e) => setEnglishoptionc(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput
                placeholder="Option D"
                onChange={(e) => setEnglishoptiond(e.target.value)}
              />
            </Grid>
          </Grid>
          <br />
          <Grid container spacing={3}>
            <Grid item xs={12} sm={9}>
              <SuiInput
                placeholder="Hindi Question         "
                onChange={(e) => setHindi(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput
                placeholder="Hindi Answer           "
                onChange={(e) => setHindians(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option A" onChange={(e) => setHindioptiona(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option B" onChange={(e) => setHindioptionb(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option C" onChange={(e) => setHindioptionc(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option D" onChange={(e) => setHindioptiond(e.target.value)} />
            </Grid>
          </Grid>
          <br />
          <Grid container spacing={3}>
            <Grid item xs={12} sm={9}>
              <SuiInput
                placeholder="Roman Question             "
                onChange={(e) => setRoman(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput
                placeholder="Roman Answer               "
                onChange={(e) => setRomanans(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option A" onChange={(e) => setRomanoptiona(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option B" onChange={(e) => setRomanoptionb(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option C" onChange={(e) => setRomanoptionc(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option D" onChange={(e) => setRomanoptiond(e.target.value)} />
            </Grid>
          </Grid>
          <br />
          <Grid container spacing={3}>
            <Grid item xs={12} sm={9}>
              <SuiInput
                placeholder="Urdu Question              "
                onChange={(e) => setUrdu(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput
                placeholder="Urdu Answer                  "
                onChange={(e) => setUrduans(e.target.value)}
              />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option A" onChange={(e) => setUrduoptiona(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option B" onChange={(e) => setUrduoptionb(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option C" onChange={(e) => setUrduoptionc(e.target.value)} />
            </Grid>
            <Grid item xs={12} sm={3}>
              <SuiInput placeholder="Option D" onChange={(e) => setUrduoptiond(e.target.value)} />
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
