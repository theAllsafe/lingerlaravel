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

// react-leaflet map components
import { Map, TileLayer } from "react-leaflet";

// @mui material components
import Grid from "@mui/material/Grid";
import Divider from "@mui/material/Divider";
import Hidden from "@mui/material/Hidden";
import Slider from "@mui/material/Slider";
import Tooltip from "@mui/material/Tooltip";
import Icon from "@mui/material/Icon";

// Soft UI Dashboard PRO React components
import SuiBox from "components/SuiBox";
import SuiTypography from "components/SuiTypography";
import SuiButton from "components/SuiButton";
import SuiInput from "components/SuiInput";
import SuiAvatar from "components/SuiAvatar";

// Custom styles for the AutomotiveMonitor
import styles from "layouts/dashboards/automotive/components/AutomotiveMonitor/styles";

// Images
import curved10 from "assets/images/curved-images/curved10.jpg";
import spotifyLogo from "assets/images/small-logos/logo-spotify.svg";

function AutomotiveMonitor() {
  const classes = styles();

  return (
    <SuiBox backgroundColor="dark" borderRadius="xl" position="relative" backgroundGradient>
      <SuiBox p={3}>
        <Grid container spacing={3} justifyContent="space-between" alignItems="center">
          <Grid item xs={12} md={6} lg={4}>
            <SuiInput
              size="large"
              withIcon={{ icon: "search", direction: "left" }}
              placeholder="Search anything..."
              customClass={classes.automotiveMonitor_input}
            />
          </Grid>
          <Grid item xs={12} md={6} lg={6} my="auto" ml="auto">
            <SuiBox display="flex" justifyContent="flex-end" alignItems="center">
              <SuiBox color="white" lineHeight={0} ml={{ xs: 1, sm: 2 }}>
                <Tooltip title="Headphones connected" placement="top" arrow>
                  <Icon className="" fontSize="default">
                    headphones
                  </Icon>
                </Tooltip>
              </SuiBox>
              <SuiBox color="white" lineHeight={0} ml={{ xs: 1, sm: 2 }}>
                <Tooltip title="Music is playing" placement="top" arrow>
                  <Icon className="" fontSize="large">
                    play_arrow
                  </Icon>
                </Tooltip>
              </SuiBox>
              <SuiBox color="white" lineHeight={0} ml={{ xs: 1, sm: 2 }}>
                <Tooltip title="Start radio" placement="top" arrow>
                  <Icon className="" fontSize="default">
                    power_settings_new
                  </Icon>
                </Tooltip>
              </SuiBox>
              <SuiBox color="white" lineHeight={0} ml={{ xs: 1, sm: 2 }}>
                <Tooltip title="Time tracker" placement="top" arrow>
                  <Icon className="" fontSize="default">
                    timer
                  </Icon>
                </Tooltip>
              </SuiBox>
              <SuiBox ml={{ xs: 1.5, sm: 3 }}>
                <SuiTypography variant="h4" textColor="white">
                  10:45
                </SuiTypography>
              </SuiBox>
            </SuiBox>
          </Grid>
        </Grid>
        <Divider light />
        <Grid container spacing={3}>
          <Grid item xs={12} md={6} lg={4}>
            <SuiBox display="flex" alignItems="center" position="relative">
              <SuiTypography variant="h3" textColor="white" fontWeight="bold">
                11:13
              </SuiTypography>
              <SuiBox ml={2}>
                <SuiTypography variant="body2" textColor="white" opacity={0.8}>
                  Estimated arrival time
                </SuiTypography>
              </SuiBox>
              <Hidden smDown>
                <SuiBox ml="auto" height="2.5rem">
                  <Divider orientation="vertical" light />
                </SuiBox>
              </Hidden>
            </SuiBox>
          </Grid>
          <Grid item xs={12} md={6} lg={4}>
            <SuiBox display="flex" justifyContent="center" alignItems="center" position="relative">
              <SuiBox ml={{ md: "auto" }}>
                <SuiTypography variant="h3" textColor="white" fontWeight="bold">
                  2.4
                  <SuiTypography variant="button" textColor="white" verticalAlign="top">
                    Km
                  </SuiTypography>
                </SuiTypography>
              </SuiBox>
              <SuiBox ml={2} mr="auto">
                <SuiTypography variant="body2" textColor="white" opacity={0.8}>
                  Turn right in 2.4 miles
                </SuiTypography>
              </SuiBox>
              <Hidden mdDown>
                <SuiBox height="2.5rem">
                  <Divider orientation="vertical" light />
                </SuiBox>
              </Hidden>
            </SuiBox>
          </Grid>
          <Grid item xs={12} md={6} lg={4}>
            <SuiBox display="flex" alignItems="center" position="relative">
              <SuiBox ml={{ xs: 0, lg: "auto" }}>
                <SuiTypography variant="h3" textColor="white" fontWeight="bold">
                  6.3
                  <SuiTypography variant="button" textColor="white" verticalAlign="top">
                    Km
                  </SuiTypography>
                </SuiTypography>
              </SuiBox>
              <SuiBox ml={2}>
                <SuiTypography variant="body2" textColor="white" opacity={0.8}>
                  Distance to Creative Tim
                </SuiTypography>
              </SuiBox>
            </SuiBox>
          </Grid>
        </Grid>
      </SuiBox>
      <SuiBox width="100%" height="16rem">
        <Map center={[38.89, -77.03]} zoom={11} maxZoom={19} className="w-100 h-100">
          <TileLayer
            url="https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png"
            attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>'
          />
        </Map>
      </SuiBox>
      <SuiBox p={3}>
        <Grid container spacing={3} alignItems="center">
          <Grid item xs={12} md={6} lg={4}>
            <SuiBox display="flex" alignItems="center">
              <SuiBox position="relative">
                <SuiAvatar src={curved10} alt="kal" size="lg" />
                <SuiBox
                  component="img"
                  src={spotifyLogo}
                  alt="spotify logo"
                  position="absolute"
                  right={0}
                  bottom={-7}
                  width="60%"
                  mr={-2}
                />
              </SuiBox>
              <SuiBox px={2}>
                <SuiTypography component="p" variant="button" fontWeight="medium" textColor="white">
                  You&apos;re Mines Still (feat Drake)
                </SuiTypography>
                <SuiTypography
                  component="p"
                  variant="caption"
                  textColor="white"
                  opacity={0.8}
                  gutterBottom
                >
                  Yung Bleu - Hip-Hop
                </SuiTypography>
              </SuiBox>
            </SuiBox>
          </Grid>
          <Grid item xs={12} md={6} lg={4}>
            <SuiBox display="flex" alignItems="center" justifyContent="center">
              <SuiButton
                variant="outlined"
                size="large"
                circular
                iconOnly
                customClass={classes.automotiveMonitor_button}
              >
                <Icon className="">skip_previous</Icon>
              </SuiButton>
              <SuiButton
                variant="outlined"
                size="large"
                circular
                iconOnly
                customClass={classes.automotiveMonitor_button}
              >
                <Icon className="">pause</Icon>
              </SuiButton>
              <SuiButton
                variant="outlined"
                size="large"
                circular
                iconOnly
                customClass={classes.automotiveMonitor_button}
              >
                <Icon className="">skip_next</Icon>
              </SuiButton>
            </SuiBox>
          </Grid>
          <Grid item xs={8} md={6} lg={2}>
            <SuiBox mb={-2}>
              <SuiTypography variant="body2" textColor="white">
                Volume
              </SuiTypography>
              <Slider defaultValue={50} className={classes.automotiveMonitor_slider} />
            </SuiBox>
          </Grid>
          <Grid item xs={4} md={6} lg={1} className={classes.automotiveMonitor_lastGrid}>
            <SuiBox display="flex" alignItems="center">
              <SuiBox color="white" lineHeight={0}>
                <Tooltip title="Hide menu" placement="top" arrow>
                  <Icon className="" fontSize="small">
                    format_list_bulleted
                  </Icon>
                </Tooltip>
              </SuiBox>
              <SuiBox color="white" lineHeight={0} ml={2}>
                <Tooltip title="Track messages" placement="top" arrow>
                  <Icon className="" fontSize="small">
                    mode_comment
                  </Icon>
                </Tooltip>
              </SuiBox>
            </SuiBox>
          </Grid>
        </Grid>
      </SuiBox>
    </SuiBox>
  );
}

export default AutomotiveMonitor;
