<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RoleAuth implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\ResponseInterface. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            session()->setFlashdata('error', 'Please login to access this page.');
            return redirect()->to(base_url('login'));
        }

        // Get user role from session
        $userRole = session()->get('role');
        $currentPath = $request->getUri()->getPath();

        // Define role-based access rules
        $accessRules = [
            'admin' => [
                'allowed' => ['/admin', '/announcements', '/dashboard', '/logout'],
                'description' => 'Admin can access admin routes and announcements'
            ],
            'teacher' => [
                'allowed' => ['/teacher', '/announcements', '/dashboard', '/logout'],
                'description' => 'Teacher can access teacher routes and announcements'
            ],
            'student' => [
                'allowed' => ['/student', '/announcements', '/dashboard', '/logout'],
                'description' => 'Student can access student routes and announcements'
            ]
        ];

        // Check if user has permission to access the current route
        if (isset($accessRules[$userRole])) {
            $allowedRoutes = $accessRules[$userRole]['allowed'];
            $hasAccess = false;

            // Check if current path starts with any allowed route
            foreach ($allowedRoutes as $allowedRoute) {
                if (strpos($currentPath, $allowedRoute) === 0) {
                    $hasAccess = true;
                    break;
                }
            }

            // If no access, redirect with error message
            if (!$hasAccess) {
                session()->setFlashdata('error', 'Access Denied: Insufficient Permissions');
                return redirect()->to(base_url('announcements'));
            }
        } else {
            // Unknown role, redirect to announcements
            session()->setFlashdata('error', 'Access Denied: Invalid User Role');
            return redirect()->to(base_url('announcements'));
        }
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}

