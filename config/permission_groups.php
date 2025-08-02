<?php
$map = ['read', 'create', 'update', 'delete'];
$patients_map = [
    'read',
    'create',
    'update',
    'delete',
    'transfer',
    'check_phone',
    'read_lab_requests',
    'read_scan_requests'
];
$r_d_map = ['read', 'delete'];
$r_u_map = ['read', 'update'];
$r_u_d_map = ['read', 'update', 'delete'];
return [
    'dashboard' => [
        'settings' => $r_u_map,
        'notifications' => $r_d_map,
        'categories' => $map,
        'home_general_statistics' => ['read'],
        'warehouses' => $map,
        'lab_requests' => $map,
        'home_doctor_statistice' => ['read'],

    ],
    'patients' => [

        'patients' => $patients_map,
        'appointments' => $map,
        'transferred' => ['read'],
        'queue' => ['read'],
        'visits' => ['read', 'delete', 'pay'],
        'diagnoses' => $r_u_d_map,
    ],
    'financial' => [
        'expenses' => $map,
        'purchases' => $map,
        'invoices' => array_merge($map, ['discount']),
        'reports' => ['read'],
        'supplies' => $map,
        'offers' => $map

    ],

    'users' => [
        'supervisors' => $map,
        'employees' => $map,
        'groups' => $map,
    ],

    'pharmacy' => [
        'pharmacy_statistics' => ['read'],
        'pharmacy_types' => $map,
        'pharmacy_warehouse' => $map,
        'pharmacy_descriptions' => ['read', 'dispense', 'delete'],
        'pharmacy_medicine' => $map,
        'pharmacy_dangerous' => $map,
    ],
    'products_and_warehouses' => [
        'products' => array_merge($map, ['report', 'inventory_movement', 'add_quantity']),
        'orders' => ['read', 'retrieve', 'delete'],
        'pos' => ['read'],
        'inventory' => ['sub_quantity'],
        'kinds' => $map,
        'forms' => $map,
        //        'units' => $map,
        'suppliers' => $map,
        'items' => array_merge($map, ['charge', 'expense', 'inventory_movement', 'report']),
    ],
    'mkhtbr' => [
        'packages' => $map,
        'analysis' => $map,
        'analysis_departments' => $map
    ],

    'other' => [

        'departments' => $map,
    ]

];