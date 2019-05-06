const Home = () => import('../components/HomePage/index.vue');
const OnsVerhaal = () => import('../components/OnsVerhaalPage/index.vue');
const Contact = () => import('../components/ContactPage/index.vue');
const RegistrationSpecialist = () => import('../components/RegistrationSpecialistPage/index.vue');
const Specialist = () => import('../components/SpecialistsPage/index.vue');
const Profile = () => import('../components/ProfilePage/index.vue');
const OrderSpecialist = () => import('../components/OrderSpecialistPage/index.vue');
// const HuurEenSpecialist = () => import('../components/HuurEenSpecialist.vue');
// const ConfirmationSpecialist = () => import('../components/ConfirmationSpecialist.vue');


export default [
    { path: '/', component: Home },
    { path: '/huurEenSpecialist', component: Specialist},
    { path: '/onsVerhaal', component: OnsVerhaal },
    { path: '/orderSpecialist/:id', component: Profile },
    { path: '/contact', component: Contact },
    { path: '/specialist', component: RegistrationSpecialist },
    { path: '/profile', component: OrderSpecialist },
    // { path: '/registrationSpecialist', component: HuurEenSpecialist },
    // { path: '/confirmationSpecialist', component: HuurEenSpecialist },
];
