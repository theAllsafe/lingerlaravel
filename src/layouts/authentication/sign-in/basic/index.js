import { useState } from "react";

// react-router-dom components
import { useHistory } from "react-router-dom";
// import { axios } from "axios";
// @mui material components
import Card from "@mui/material/Card";
import Switch from "@mui/material/Switch";
import Icon from "@mui/material/Icon";
// react-router-dom components
// import { Link } from "react-router-dom";
// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
import SuiInput from "components/SuiInput";
import SuiButton from "components/SuiButton";

// Authentication layout components
import BasicLayout from "layouts/authentication/components/BasicLayout";
import SuiAlert from "components/SuiAlert";
import curved9 from "assets/images/curved-images/curved9.jpg";

function Login() {
  const [errorcode, setErrorCode] = useState("");
  const [rememberMe, setRememberMe] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const history = useHistory();
  const [errorMessage, setErrorMessage] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const handleSetRememberMe = () => setRememberMe(!rememberMe);
  const loginHandler = async () => {
    setIsLoading(true);
    const item = { email, password };
    let result = await fetch(`${process.env.REACT_APP_DHEERAJ_KEY}admin-signin`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
      },
      body: JSON.stringify(item),
    });
    result = await result.json();
    localStorage.setItem("user-info", JSON.stringify(result.user));
    setIsLoading(false);
    setErrorCode(result.code);
    if (result.code === 200) {
      history.push("/dashboards");
    } else {
      setErrorMessage(result.message);
    }
  };
  return (
    <BasicLayout title="Linger" image={curved9}>
      <Card>
        {errorMessage && (
          <SuiAlert color={errorcode === 200 ? "success" : "error"}>
            <Icon className="material-icons-round" fonSize="small">
              thumb_up
            </Icon>
            <SuiTypography variant="body2" textColor="white">
              {errorMessage}
            </SuiTypography>
          </SuiAlert>
        )}
        <SuiBox p={3} mb={1} textAlign="center">
          <SuiTypography variant="h5" fontWeight="medium">
            Sign in
          </SuiTypography>
        </SuiBox>
        <SuiBox p={3}>
          <SuiBox component="form">
            <SuiBox mb={2}>
              <SuiInput
                type="email"
                onChange={(e) => setEmail(e.target.value)}
                placeholder="Email"
              />
            </SuiBox>
            <SuiBox mb={2}>
              <SuiInput
                type="password"
                onChange={(e) => setPassword(e.target.value)}
                placeholder="Password"
              />
            </SuiBox>
            <SuiBox display="flex" alignItems="center">
              <Switch checked={rememberMe} onChange={handleSetRememberMe} />
              <SuiTypography
                variant="button"
                fontWeight="regular"
                onClick={handleSetRememberMe}
                customClass="cursor-pointer user-select-none"
              >
                &nbsp;&nbsp;Remember me
              </SuiTypography>
            </SuiBox>
            <SuiBox mt={4} mb={1}>
              {!isLoading ? (
                <SuiButton
                  onClick={loginHandler}
                  type="button"
                  variant="gradient"
                  buttonColor="info"
                  fullWidth
                >
                  sign in
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
    </BasicLayout>
  );
}

export default Login;
