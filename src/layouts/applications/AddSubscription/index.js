import { useState, useLayoutEffect } from "react";

// @mui material components
import Grid from "@mui/material/Grid";
import Card from "@mui/material/Card";
import Icon from "@mui/material/Icon";
// import Stepper from "@mui/material/Stepper";
// import Step from "@mui/material/Step";
// import StepLabel from "@mui/material/StepLabel";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
// import SuiTypography from "components/SuiTypography";
import SuiButton from "components/SuiButton";

// Soft UI Dashboard PRO React example components
import DashboardLayout from "examples/LayoutContainers/DashboardLayout";
import DashboardNavbar from "examples/Navbars/DashboardNavbar";
import Footer from "examples/Footer";
import SuiTypography from "components/SuiTypography";
// Soft UI Dashboard PRO React components
import SuiEditor from "components/SuiEditor";
import FormField from "layouts/applications/wizard/components/FormField";
import SuiAlert from "components/SuiAlert";

function Wizard() {
  const [isLoading, setIsLoading] = useState(false);
  useLayoutEffect(() => {
    window.scroll(0, 1000);
    return () => {};
  }, []);
  const [errorMessage, setErrorMessage] = useState("");
  const [errorcode, setErrorCode] = useState("");
  const [type, setType] = useState("");
  const [title, setTitle] = useState("");
  const [price, setPrice] = useState("");
  const [description, setDescription] = useState("");
  const loginHandler = async () => {
    setIsLoading(true);
    const item = { type, title, price, description };
    let result = await fetch("http://localhost:8000/api/admin/subscription/store", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify(item),
    });
    result = await result.json();
    setErrorCode(result.code);
    if (result.code) {
      setErrorMessage(result.message);
    }
    setIsLoading(false);
  };

  return (
    <DashboardLayout>
      <DashboardNavbar />
      <SuiBox pt={3} pb={8}>
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
        <Grid container justifyContent="center">
          <Grid item xs={12} lg={12}>
            <Card>
              <SuiBox p={2}>
                <SuiBox width="80%" textAlign="center" mx="auto" mb={4}>
                  <SuiBox mb={1}>
                    <SuiTypography variant="h5" fontWeight="regular">
                      Add Subscription
                    </SuiTypography>
                  </SuiBox>
                </SuiBox>
                <SuiBox>
                  <Grid container spacing={3}>
                    <Grid item xs={12} sm={12}>
                      <SuiBox mb={2}>
                        <FormField
                          type="text"
                          onChange={(e) => setType(e.target.value)}
                          label="type"
                          placeholder="Type"
                        />
                      </SuiBox>
                      <SuiBox mb={2}>
                        <FormField
                          type="text"
                          onChange={(e) => setTitle(e.target.value)}
                          label="title"
                          placeholder="Title"
                        />
                      </SuiBox>
                      <SuiBox mb={2}>
                        <FormField
                          type="text"
                          onChange={(e) => setPrice(e.target.value)}
                          label="Price"
                          placeholder="Price"
                        />
                      </SuiBox>
                      <SuiEditor value={setDescription} onChange={setDescription} />
                    </Grid>
                  </Grid>
                  <SuiBox mt={3} width="100%" display="flex" justifyContent="space-between">
                    {!isLoading ? (
                      <SuiButton onClick={loginHandler} variant="gradient" buttonColor="dark">
                        Submit
                      </SuiButton>
                    ) : (
                      <SuiButton variant="gradient" buttonColor="warning">
                        Processing.....
                      </SuiButton>
                    )}
                  </SuiBox>
                </SuiBox>
              </SuiBox>
            </Card>
          </Grid>
        </Grid>
      </SuiBox>
      <Footer />
    </DashboardLayout>
  );
}

export default Wizard;
