import React, { ReactElement } from 'react';

// Icon data.
{/* <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="2" y="5" width="12" height="4" rx="0.5" stroke="black"/>
<path d="M2 3H14" stroke="black" stroke-linecap="round"/>
<path d="M2 11H14" stroke="black" stroke-linecap="round"/>
<path d="M2 13H14" stroke="black" stroke-linecap="round"/>
</svg>
 */}


const name = 'divi-tutor/buttons'; // Unique name.
const viewBox = '0 0 16 16'; // You will need to adjust this to match your SVG.
const component = () => (
    <>
        <path d="M7.5 9H2C1.44772 9 1 8.55228 1 8V5C1 4.44772 1.44772 4 2 4H13.5C14.0523 4 14.5 4.44772 14.5 5V8C14.5 8.55228 14.0523 9 13.5 9" stroke="black" stroke-width="0.7" fill="none" />
        <path d="M10.5623 12.5691L11.4961 14.1079C11.5248 14.1551 11.5863 14.1702 11.6335 14.1415L13.3931 13.0738C13.4403 13.0451 13.4553 12.9836 13.4267 12.9364L12.4929 11.3976C12.4642 11.3503 12.4793 11.2888 12.5265 11.2602L13.9998 10.3661C14.0663 10.3258 14.0633 10.2284 13.9946 10.1922L9.12852 7.62817C9.06444 7.59441 8.98684 7.63784 8.98211 7.71011L8.60645 13.4549C8.60117 13.5357 8.68895 13.5889 8.75812 13.547L10.4249 12.5355C10.4721 12.5068 10.5336 12.5219 10.5623 12.5691Z" stroke="black" stroke-width="0.5" stroke-linecap="round" />

    </>

); // Your SVG path. without the svg tag.


export default {
    name,
    viewBox,
    component,
};