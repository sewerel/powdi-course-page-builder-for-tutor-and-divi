import React, { ReactElement } from 'react';

// Icon data.
{/* <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect x="1" y="5" width="14" height="4" rx="0.5" stroke="black"/>
<path d="M3 8.00513L5 6" stroke="black" stroke-linecap="round"/>
<path d="M1 8.00513L3 6" stroke="black" stroke-linecap="round"/>
<path d="M7 8.00513L9 6" stroke="black" stroke-linecap="round"/>
<path d="M5 8.00513L7 6" stroke="black" stroke-linecap="round"/>
</svg>


 */}


const name = 'divi-tutor/status'; // Unique name.
const viewBox = '0 0 16 16'; // You will need to adjust this to match your SVG.
const component = () => (
    <>
        <rect x="1" y="5" width="14" height="4" rx="0.5" stroke="black" fill="none" />
        <path d="M3 8.00513L5 6" stroke="black" stroke-linecap="round" />
        <path d="M1 8.00513L3 6" stroke="black" stroke-linecap="round" />
        <path d="M7 8.00513L9 6" stroke="black" stroke-linecap="round" />
        <path d="M5 8.00513L7 6" stroke="black" stroke-linecap="round" />
    </>

); // Your SVG path. without the svg tag.


export default {
    name,
    viewBox,
    component,
};