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

/* eslint-disable react/prop-types */
// Soft UI Dashboard PRO React components
import SuiBadge from "components/SuiBadge";

// ProductsList page components
// import ProductCell from "layouts/ecommerce/products/products-list/components/ProductCell";
import ActionCell from "layouts/ecommerce/products/products-list/components/ActionCell";

// Badges
const outOfStock = (
  <SuiBadge
    variant="contained"
    color="error"
    size="extra-small"
    badgeContent="in active"
    container
  />
);
const inStock = (
  <SuiBadge
    variant="contained"
    color="success"
    size="extra-small"
    badgeContent=" active"
    container
  />
);

export default {
  columns: [
    { Header: "Sh.NO", accessor: "shno" },
    { Header: "Time Slot", accessor: "time" },
    { Header: "Date", accessor: "date" },
    { Header: "Question", accessor: "Question" },
    {
      Header: "status",
      accessor: "status",
      Cell: ({ value }) => (value === "in stock" ? inStock : outOfStock),
    },
    { Header: "action", accessor: "action" },
  ],

  rows: [
    {
      shno: "1",
      time: "10:00-12:00",
      date: "20/11/2021",
      Question: "What is the role of education in home?",
      status: "out of stock",
      action: <ActionCell />,
    },
    {
      shno: "2",
      time: "10:00-12:00",
      date: "20/11/2021",
      Question: "What is the role of education in home?",
      status: "in stock",
      action: <ActionCell />,
    },
  ],
};
