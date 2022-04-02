/** 
  All of the routes for the Soft UI Dashboard PRO Material are added here,
  You can add a new route, customize the routes and delete the routes here.

  Once you add a new route on this file it will be visible automatically on
  the Sidenav.

  For adding a new route you can follow the existing routes in the routes array.
  1. The `type` key with the `collapse` value is used for a route.
  2. The `type` key with the `title` value is used for a title inside the Sidenav. 
  3. The `type` key with the `divider` value is used for a divider between Sidenav items.
  4. The `name` key is used for the name of the route on the Sidenav.
  5. The `key` key is used for the key of the route (It will help you with the key prop inside a loop).
  6. The `icon` key is used for the icon of the route on the Sidenav, you have to add a node.
  7. The `collapse` key is used for making a collapsible item on the Sidenav that has other routes
  inside (nested routes), you need to pass the nested routes inside an array as a value for the `collapse` key.
  8. The `route` key is used to store the route location which is used for the react router.
  9. The `href` key is used to store the external links location.
  10. The `title` key is only for the item with the type of `title` and its used for the title text on the Sidenav.
  10. The `component` key is used to store the component of its route.
*/

// Soft UI Dashboard PRO React layouts
import Login from "layouts/authentication/sign-in/basic";
import Deshboard from "layouts/dashboards/default";
// import Automotive from "layouts/dashboards/automotive";
import SmartHome from "layouts/dashboards/smart-home";
// customer management
import ProfileOverview from "layouts/pages/profile/profile-overview";
import HomeSettings from "layouts/customerManagement/homeSettings";
import babyNames from "layouts/customerManagement/babyNames";
import islam from "layouts/customerManagement/islam";
import addDuaWazifa from "layouts/customerManagement/DuaWazifa/new-duaWazifa";
import listDuaWazifa from "layouts/customerManagement/DuaWazifa/duaWazifa-list";
import addIslamicFestivals from "layouts/customerManagement/IslamicFestivals/new-islamicFestivals";
import listIslamicFestivals from "layouts/customerManagement/IslamicFestivals/islamicFestivals-list";
import addIslamicHeroes from "layouts/customerManagement/IslamicHeroes/new-IslamicHeroes";
import listIslamicHeroes from "layouts/customerManagement/IslamicHeroes/IslamicHeroes-list";
import addIslamicHeroestype from "layouts/customerManagement/IslamicHeroes/new-IslamicHeroestype";
import listIslamicHeroestype from "layouts/customerManagement/IslamicHeroes/IslamicHeroestype-list";
import KhwabkiTabeer from "layouts/customerManagement/KhwabkiTabeer";
// import Teams from "layouts/pages/profile/teams";
import listSubscription from "layouts/applications/Subscription";
import AddSubscription from "layouts/applications/AddSubscription";
import DataTables from "layouts/applications/data-tables";
import NewQuestions from "layouts/quizzManagement/hindi/new-questions";
import Hindi from "layouts/quizzManagement/hindi/questions-list";
// Quizz
// import addtimeslot from "layouts/quizzManagement/timeslot/new-timeslot";
import timeslot from "layouts/quizzManagement/timeslot/timeslot-list";
import addseason from "layouts/quizzManagement/season/new-season";
import editseason from "layouts/quizzManagement/season/edit-season";
import season from "layouts/quizzManagement/season/season-list";
// import SignInBasic from "layouts/authentication/sign-in/basic";
import Note from "layouts/quizzManagement/note";
// import Notice from "layouts/quizzManagement/notice";
// import SignInCover from "layouts/authentication/sign-in/cover";
import dailytopper from "layouts/leaderBoard/dailytopper";
import weeklytopper from "layouts/leaderBoard/weeklytopper";
import Seasonrank from "layouts/leaderBoard/seasonrank";
import users from "layouts/leaderBoard/users";
// Information System
import sukoon from "layouts/informationSystem/sukoon/new-sukoon";
import sukoonlist from "layouts/informationSystem/sukoon/sukoon-list";
import sunnah from "layouts/informationSystem/sunnah/new-sunnah";
import sunnahlist from "layouts/informationSystem/sunnah/sunnah-list";
// Library
import book from "layouts/library/book/new-book";
import booklist from "layouts/library/book/book-list";
import audiosummary from "layouts/library/audio-summary/new-audio-summary";
import audiosummarylist from "layouts/library/audio-summary/audio-summary-list";
import chapter from "layouts/library/chapter/new-chapter";
import chapterlist from "layouts/library/chapter/chapter-list";
// Courses
import courses from "layouts/courses/courses/new-courses";
import courseslist from "layouts/courses/courses/courses-list";
import setting from "layouts/courses/courses/setting";
// Information System
import otherusers from "layouts/other-users/users/new-users";
import otheruserslist from "layouts/other-users/users/users-list";
// import SignUpBasic from "layouts/authentication/sign-up/basic";
// import SignUpCover from "layouts/authentication/sign-up/cover";
// import SignUpIllustration from "layouts/authentication/sign-up/illustration";
// import ResetBasic from "layouts/authentication/reset-password/basic";
// import ResetCover from "layouts/authentication/reset-password/cover";
// import ResetIllustration from "layouts/authentication/reset-password/illustration";
// import LockBasic from "layouts/authentication/lock/basic";
// import LockCover from "layouts/authentication/lock/cover";
// import LockIllustration from "layouts/authentication/lock/illustration";
// import VerificationBasic from "layouts/authentication/2-step-verification/basic";
// import VerificationCover from "layouts/authentication/2-step-verification/cover";
// import VerificationIllustration from "layouts/authentication/2-step-verification/illustration";
// import Error404 from "layouts/authentication/error/404";
// import Error500 from "layouts/authentication/error/500";

// Soft UI Dashboard PRO React icons
// import Shop from "examples/Icons/Shop";
import Office from "examples/Icons/Office";
import SettingsIcon from "examples/Icons/Settings";
import Basket from "examples/Icons/Basket";
import Document from "examples/Icons/Document";
import SpaceShip from "examples/Icons/SpaceShip";
import CustomerSupport from "examples/Icons/CustomerSupport";
import CreditCard from "examples/Icons/CreditCard";

const routes = [
  {
    type: "collapse",
    name: "Dashboardsr",
    key: "dashboards",
    role: "2",
    icon: <Office size="12px" />,
    collapse: [
      {
        name: "Dashboards",
        route: "/dashboards",
        component: Deshboard,
      },
    ],
  },
  {
    type: "collapse",
    name: "Order Management",
    key: "OrderManagement",
    role: "1",
    icon: <CreditCard size="12px" />,
    collapse: [
      {
        name: "Package(Subscription)",
        key: "subscription",
        collapse: [
          {
            name: "Add Subscription",
            key: "AddSubscription",
            route: "/OrderManagement/subscription/AddSubscription",
            component: AddSubscription,
          },
          {
            name: "List Subscription",
            key: "listSubscription",
            route: "/OrderManagement/subscription/listSubscription",
            component: listSubscription,
          },
        ],
      },
      {
        name: "Subscription List",
        key: "subscriptionlist",
        collapse: [
          {
            name: "Paid",
            key: "paid",
            route: "/OrderManagement/subscriptionlist/paid",
            component: SmartHome,
          },
          {
            name: "Free",
            key: "free",
            route: "/OrderManagement/subscriptionlist/free",
            component: DataTables,
          },
        ],
      },
      {
        name: "Invoices",
        key: "data-tables",
        route: "/OrderManagement/data-tables",
        component: DataTables,
      },
    ],
  },
  {
    type: "collapse",
    name: "Quizz Management",
    key: "QuizzManagement",
    role: "1",
    icon: <CustomerSupport size="12px" />,
    collapse: [
      {
        name: "Time Slot",
        key: "Slot",
        collapse: [
          // {
          //   name: "Add time slot",
          //   key: "addtimeslot",
          //   route: "/QuizzManagement/Slot/addtimeslot",
          //   component: addtimeslot,
          // },
          {
            name: "Time slot list",
            key: "timeslot",
            route: "/QuizzManagement/Slot/timeslot",
            component: timeslot,
          },
        ],
      },
      {
        name: "Season",
        key: "season",
        collapse: [
          {
            name: "Add Season",
            key: "addseason",
            route: "/QuizzManagement/season/addseason",
            component: addseason,
          },
          {
            name: "Season list",
            key: "season",
            route: "/QuizzManagement/season/season",
            component: season,
          },
        ],
      },
      {
        name: "Note",
        key: "quizz",
        collapse: [
          {
            name: "Note",
            key: "note",
            route: "/QuizzManagement/quizz/note",
            component: Note,
          },
        ],
      },
      // {
      //   name: "Notice",
      //   key: "quizz",
      //   collapse: [
      //     {
      //       name: "Notice",
      //       key: "notice",
      //       route: "/QuizzManagement/quizz/notice",
      //       component: Notice,
      //     },
      //   ],
      // },
      {
        name: "Questions",
        key: "questions",
        collapse: [
          {
            name: "Add Questions",
            key: "AddQuestions",
            route: "/QuizzManagement/questions/AddQuestions",
            component: NewQuestions,
          },
          {
            name: "Questions List",
            key: "Hindi",
            route: "/QuizzManagement/questions/Hindi",
            component: Hindi,
          },
        ],
      },
    ],
  },
  {
    type: "collapse",
    name: "LeaderBoard",
    key: "leaderBoard",
    role: "1",
    icon: <SpaceShip size="12px" />,
    collapse: [
      {
        name: "All Users",
        key: "users",
        route: "/leaderBoard/users",
        component: users,
      },
      {
        name: "Paid",
        key: "Seasonrank",
        collapse: [
          {
            name: "Season Rank",
            key: "Seasonrank",
            route: "/leaderBoard/Seasonrank",
            component: Seasonrank,
          },
          {
            name: "Weekly Topper",
            key: "weeklytopper",
            route: "/leaderBoard/weeklytopper",
            component: weeklytopper,
          },
          {
            name: "Daily Topper",
            key: "dailytopper",
            route: "/leaderBoard/dailytopper",
            component: dailytopper,
          },
        ],
      },
      {
        name: "Free",
        key: "Seasonrank",
        collapse: [
          {
            name: "Daily Topper",
            key: "dailytopper",
            route: "/leaderBoard/dailytopper",
            component: Seasonrank,
          },
        ],
      },
    ],
  },
  {
    type: "collapse",
    name: "Customer Management",
    key: "Profile",
    role: "1",
    icon: <SettingsIcon size="12px" />,
    collapse: [
      {
        name: "Home Settings",
        key: "HomeSettings",
        route: "/Profile/HomeSettings",
        component: HomeSettings,
      },
      {
        name: "What is Islam",
        key: "islam",
        route: "/Profile/islam",
        component: islam,
      },
      {
        name: "Dua & Wazifa",
        key: "Dua&Wazifa",
        collapse: [
          {
            name: "Add DuaWazifa",
            key: "addDuaWazifa",
            route: "/Profile/Dua&Wazifa/addDuaWazifa",
            component: addDuaWazifa,
          },
          {
            name: "DuaWazifa list",
            key: "listDuaWazifa",
            route: "/Profile/Dua&Wazifa/listDuaWazifa",
            component: listDuaWazifa,
          },
        ],
      },
      {
        name: "Islamic Festivals",
        key: "IslamicFestivals",
        collapse: [
          {
            name: "Add Islamic Festivals",
            key: "addIslamicFestivals",
            route: "/Profile/IslamicFestivals/addIslamicFestivals",
            component: addIslamicFestivals,
          },
          {
            name: "Islamic Festivals list",
            key: "listIslamicFestivals",
            route: "/Profile/IslamicFestivals/listIslamicFestivals",
            component: listIslamicFestivals,
          },
        ],
      },
      {
        name: "Islamic Heroes",
        key: "IslamicHeroes",
        collapse: [
          {
            name: "Add Islamic Heroes",
            key: "addIslamicHeroes",
            route: "/Profile/IslamicHeroes/addIslamicHeroes",
            component: addIslamicHeroes,
          },
          {
            name: "Islamic Heroes list",
            key: "listIslamicHeroes",
            route: "/Profile/IslamicHeroes/listIslamicHeroes",
            component: listIslamicHeroes,
          },
        ],
      },
      {
        name: "Islamic Heroes Type",
        key: "IslamicHeroestype",
        collapse: [
          {
            name: "Add Islamic Heroes Type",
            key: "addIslamicHeroestype",
            route: "/Profile/IslamicHeroestype/addIslamicHeroestype",
            component: addIslamicHeroestype,
          },
          {
            name: "Islamic Heroes Type list",
            key: "listIslamicHeroestype",
            route: "/Profile/IslamicHeroestype/listIslamicHeroestype",
            component: listIslamicHeroestype,
          },
        ],
      },
      {
        name: "Khwab ki Tabeer",
        key: "KhwabkiTabeer",
        route: "/Profile/KhwabkiTabeer",
        component: KhwabkiTabeer,
      },
      {
        name: "Baby Names",
        key: "babyNames",
        route: "/Profile/babyNames",
        component: babyNames,
      },
    ],
  },
  {
    type: "collapse",
    name: "Information System",
    key: "InformationSystem",
    role: "1",
    icon: <Document size="12px" />,
    collapse: [
      {
        name: "Reward Information",
        key: "ProfileOverview",
        route: "/InformationSystem/ProfileOverview",
        component: ProfileOverview,
      },
      {
        name: "Sunnah",
        key: "Sunnah",
        collapse: [
          {
            name: "Add Sunnah",
            key: "Sunnah",
            route: "/InformationSystem/Sunnah/sunnah",
            component: sunnah,
          },
          {
            name: "Sunnah list",
            key: "sunnahlist",
            route: "/InformationSystem/Sunnah/sunnahlist",
            component: sunnahlist,
          },
        ],
      },
      {
        name: "Sukoon",
        key: "Sukoon",
        collapse: [
          {
            name: "Add Sukoon",
            key: "Sukoon",
            route: "/InformationSystem/Sukoon/Sukoon",
            component: sukoon,
          },
          {
            name: "Sukoon list",
            key: "Sukoon",
            route: "/InformationSystem/Sukoon/sukoonlist",
            component: sukoonlist,
          },
        ],
      },
    ],
  },
  {
    type: "collapse",
    name: "Library",
    key: "library",
    role: "1",
    icon: <Document size="12px" />,
    collapse: [
      {
        name: "Books",
        key: "Books",
        collapse: [
          {
            name: "Add Book",
            key: "book",
            route: "/library/books/book",
            component: book,
          },
          {
            name: "Book list",
            key: "booklist",
            route: "/library/books/booklist",
            component: booklist,
          },
        ],
      },
      {
        name: "Chapter",
        key: "chapter",
        collapse: [
          {
            name: "Add Chapter",
            key: "chapter",
            route: "/library/chapter",
            component: chapter,
          },
          {
            name: "Chapter list",
            key: "chapterlist",
            route: "/library/chapter/chapterlist",
            component: chapterlist,
          },
        ],
      },
      {
        name: "Audio Summary",
        key: "audiosummary",
        collapse: [
          {
            name: "Add Audio",
            key: "audiosummary",
            route: "/library/audiosummary/audiosummary",
            component: audiosummary,
          },
          {
            name: "Audio list",
            key: "audiosummarylist",
            route: "/library/audiosummary/audiosummarylist",
            component: audiosummarylist,
          },
        ],
      },
    ],
  },
  {
    type: "collapse",
    name: "Courses",
    key: "courses",
    role: "1",
    icon: <Document size="12px" />,
    collapse: [
      {
        name: "Add Courses",
        key: "courses",
        route: "/courses/courses",
        component: courses,
      },
      {
        name: "Courses list",
        key: "courseslist",
        route: "/courses/courseslist",
        component: courseslist,
      },
      {
        name: "Setting",
        key: "setting",
        route: "/courses/setting",
        component: setting,
      },
    ],
  },
  {
    type: "collapse",
    name: "Users",
    key: "users",
    role: "1",
    icon: <Document size="12px" />,
    collapse: [
      {
        name: "Add Users",
        key: "otherusers",
        route: "/users/otherusers",
        component: otherusers,
      },
      {
        name: "User list",
        key: "otheruserslist",
        route: "/users/otheruserslist",
        component: otheruserslist,
      },
    ],
  },
  // {
  //   type: "collapse",
  //   name: "Courses",
  //   key: "courses",
  //   role: "1",
  //   icon: <Document size="12px" />,
  //   collapse: [
  //     {
  //       name: "Add Courses",
  //       key: "courses",
  //       route: "/courses/courses",
  //       component: courses,
  //     },
  //     {
  //       name: "Courses list",
  //       key: "courseslist",
  //       route: "/courses/courseslist",
  //       component: courseslist,
  //     },
  //   ],
  // },
  {
    type: "collapse",
    name: "Customer Management",
    key: "Profile",
    role: "0",
    icon: <Basket size="12px" />,
    collapse: [
      {
        name: "Profile",
        key: "ProfileOverview",
        route: "/Profile/ProfileOverview",
        component: ProfileOverview,
      },
      {
        name: "Login",
        key: "Login",
        route: "/Login",
        component: Login,
      },
      {
        name: "Edit Season",
        key: "season",
        route: `/QuizzManagement/season/editseason/:id`,
        component: editseason,
      },
    ],
  },
  // {
  //   type: "collapse",
  //   name: "Authentication",
  //   key: "authentication",
  //   icon: <Document size="12px" />,
  //   collapse: [
  //     {
  //       name: "Sign In",
  //       key: "sign-in",
  //       collapse: [
  //         {
  //           name: "Basic",
  //           key: "basic",
  //           route: "/authentication/sign-in/basic",
  //           component: SignInBasic,
  //         },
  //         {
  //           name: "Cover",
  //           key: "cover",
  //           route: "/authentication/sign-in/cover",
  //           component: SignInCover,
  //         },
  //         {
  //           name: "Illustration",
  //           key: "illustration",
  //           route: "/authentication/sign-in/illustration",
  //           component: SignInIllustration,
  //         },
  //       ],
  //     },
  //     {
  //       name: "Sign Up",
  //       key: "sign-up",
  //       collapse: [
  //         {
  //           name: "Basic",
  //           key: "basic",
  //           route: "/authentication/sign-up/basic",
  //           component: SignUpBasic,
  //         },
  //         {
  //           name: "Cover",
  //           key: "cover",
  //           route: "/authentication/sign-up/cover",
  //           component: SignUpCover,
  //         },
  //         {
  //           name: "Illustration",
  //           key: "illustration",
  //           route: "/authentication/sign-up/illustration",
  //           component: SignUpIllustration,
  //         },
  //       ],
  //     },
  //     {
  //       name: "Reset Password",
  //       key: "reset-password",
  //       collapse: [
  //         {
  //           name: "Basic",
  //           key: "basic",
  //           route: "/authentication/reset-password/basic",
  //           component: ResetBasic,
  //         },
  //         {
  //           name: "Cover",
  //           key: "cover",
  //           route: "/authentication/reset-password/cover",
  //           component: ResetCover,
  //         },
  //         {
  //           name: "Illustration",
  //           key: "illustration",
  //           route: "/authentication/reset-password/illustration",
  //           component: ResetIllustration,
  //         },
  //       ],
  //     },
  //     {
  //       name: "Lock",
  //       key: "lock",
  //       collapse: [
  //         {
  //           name: "Basic",
  //           key: "basic",
  //           route: "/authentication/lock/basic",
  //           component: LockBasic,
  //         },
  //         {
  //           name: "Cover",
  //           key: "cover",
  //           route: "/authentication/lock/cover",
  //           component: LockCover,
  //         },
  //         {
  //           name: "Illustration",
  //           key: "illustration",
  //           route: "/authentication/lock/illustration",
  //           component: LockIllustration,
  //         },
  //       ],
  //     },
  //     {
  //       name: "2-Step Verification",
  //       key: "2-step-verification",
  //       collapse: [
  //         {
  //           name: "Basic",
  //           key: "basic",
  //           route: "/authentication/verification/basic",
  //           component: VerificationBasic,
  //         },
  //         {
  //           name: "Cover",
  //           key: "cover",
  //           route: "/authentication/verification/cover",
  //           component: VerificationCover,
  //         },
  //         {
  //           name: "Illustration",
  //           key: "illustration",
  //           route: "/authentication/verification/illustration",
  //           component: VerificationIllustration,
  //         },
  //       ],
  //     },
  //     {
  //       name: "Error",
  //       key: "error",
  //       collapse: [
  //         {
  //           name: "Error 404",
  //           key: "error-404",
  //           route: "/authentication/error/404",
  //           component: Error404,
  //         },
  //         {
  //           name: "Error 500",
  //           key: "error-500",
  //           route: "/authentication/error/500",
  //           component: Error500,
  //         },
  //       ],
  //     },
  //   ],
  // },
  // { type: "divider", key: "divider-1" },
  // { type: "title", title: "Docs", key: "title-docs" },
  // {
  //   type: "collapse",
  //   name: "Basic",
  //   key: "basic",
  //   icon: <SpaceShip size="12px" />,
  //   collapse: [
  //     {
  //       name: "Getting Started",
  //       key: "getting-started",
  //       collapse: [
  //         {
  //           name: "Overview",
  //           key: "overview",
  //           href: "https://www.creative-tim.com/learning-lab/react/overview/soft-ui-dashboard",
  //         },
  //         {
  //           name: "License",
  //           key: "license",
  //           href: "https://www.creative-tim.com/learning-lab/react/license/soft-ui-dashboard",
  //         },
  //         {
  //           name: "Quick Start",
  //           key: "quick-start",
  //           href: "https://www.creative-tim.com/learning-lab/react/quick-start/soft-ui-dashboard",
  //         },
  //         {
  //           name: "Build Tools",
  //           key: "build-tools",
  //           href: "https://www.creative-tim.com/learning-lab/react/build-tools/soft-ui-dashboard",
  //         },
  //       ],
  //     },
  //     {
  //       name: "Foundation",
  //       key: "foundation",
  //       collapse: [
  //         {
  //           name: "Colors",
  //           key: "colors",
  //           href: "https://www.creative-tim.com/learning-lab/react/colors/soft-ui-dashboard",
  //         },
  //         {
  //           name: "Grid",
  //           key: "grid",
  //           href: "https://www.creative-tim.com/learning-lab/react/grid/soft-ui-dashboard",
  //         },
  //         {
  //           name: "Typography",
  //           key: "typography",
  //           href: "https://www.creative-tim.com/learning-lab/react/typography/soft-ui-dashboard",
  //         },
  //         {
  //           name: "Icons",
  //           key: "icons",
  //           href: "https://www.creative-tim.com/learning-lab/react/icons/soft-ui-dashboard",
  //         },
  //         {
  //           name: "Routing System",
  //           key: "routing-system",
  //           href: "https://www.creative-tim.com/learning-lab/react/routing-system/soft-ui-dashboard",
  //         },
  //       ],
  //     },
  //   ],
  // },
  // {
  //   type: "collapse",
  //   name: "Components",
  //   key: "components",
  //   icon: <CustomerSupport size="12px" />,
  //   collapse: [
  //     {
  //       name: "Alerts",
  //       key: "alerts",
  //       href: "https://www.creative-tim.com/learning-lab/react/alerts/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Badge",
  //       key: "badge",
  //       href: "https://www.creative-tim.com/learning-lab/react/badge/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Buttons",
  //       key: "buttons",
  //       href: "https://www.creative-tim.com/learning-lab/react/buttons/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Social Button",
  //       key: "social-button",
  //       href: "https://www.creative-tim.com/learning-lab/react/social-buttons/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Cards",
  //       key: "cards",
  //       href: "https://www.creative-tim.com/learning-lab/react/cards/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Collapse",
  //       key: "collapse",
  //       href: "https://www.creative-tim.com/learning-lab/react/collapse/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Dropdowns",
  //       key: "dropdowns",
  //       href: "https://www.creative-tim.com/learning-lab/react/dropdowns/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Forms",
  //       key: "forms",
  //       href: "https://www.creative-tim.com/learning-lab/react/forms/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Navs",
  //       key: "navs",
  //       href: "https://www.creative-tim.com/learning-lab/react/navs/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Pagination",
  //       key: "pagination",
  //       href: "https://www.creative-tim.com/learning-lab/react/pagination/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Popovers",
  //       key: "popovers",
  //       href: "https://www.creative-tim.com/learning-lab/react/popovers/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Progress",
  //       key: "progress",
  //       href: "https://www.creative-tim.com/learning-lab/react/progress/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Tables",
  //       key: "tables",
  //       href: "https://www.creative-tim.com/learning-lab/react/tables/soft-ui-dashboard",
  //     },
  //     {
  //       name: "Tooltips",
  //       key: "tooltips",
  //       href: "https://www.creative-tim.com/learning-lab/react/tooltips/soft-ui-dashboard",
  //     },
  //   ],
  // },
];

export default routes;
