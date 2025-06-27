# Role-Based Permission System Fixes

## Overview
Fixed role-based permission issues in the TIU-Charity admin system to ensure that users with "viewer" roles can only view data, while users with "manager" roles can both view and modify data.

## Issues Fixed

### 1. Donation Management
**Problem**: Donation viewers could update donation statuses, send thank you emails, and export data.
**Solution**: 
- Added permission checks in `AdminDonationController` for `manage_donations` permission
- Updated frontend to hide action buttons for users without management permissions
- Methods now protected: `update()`, `sendThankYou()`, `export()`

### 2. Cause Management  
**Problem**: Cause viewers could create, edit, and delete causes.
**Solution**:
- Added permission checks in `CauseController` for `manage_causes` permission
- Protected methods: `store()`, `update()`, `destroy()`

### 3. Message Management
**Problem**: Message viewers could mark messages as read.
**Solution**:
- Added permission check in `ContactController::markAsRead()` for `manage_messages` permission
- Updated frontend JavaScript to only mark messages as read for users with management permissions

### 4. Volunteer Management
**Problem**: Volunteer viewers could create projects, approve/reject applications, and manage volunteer statuses.
**Solution**:
- Added permission checks in `VolunteeringController` for `manage_volunteers` permission
- Protected methods: `storeProject()`, `update()`, `destroy()`, `approveVolunteer()`, `rejectVolunteer()`, `resetVolunteer()`

### 5. Frontend Restrictions
**Problem**: Action buttons were visible to all users regardless of permissions.
**Solution**:
- Updated view files to show disabled, grayed-out buttons for users without permissions instead of hiding them completely
- Buttons now have:
  - `disabled` attribute to prevent clicks
  - Gray colors (`text-gray-500`, `bg-gray-600`) instead of normal colors
  - `cursor-not-allowed` and `opacity-50` for visual feedback
  - Helpful tooltips explaining why the action is not available
- Form elements show as read-only for users without management permissions
- Users can see what actions exist but understand they don't have access

## Permission Structure

### Roles and Permissions:
- **Donations Viewer** (`viewer_donations`): Can only view donation data
- **Donations Manager** (`manage_donations`): Can view, update, export donations and send emails
- **Causes Viewer** (`viewer_causes`): Can only view causes
- **Causes Manager** (`manage_causes`): Can view, create, edit, delete causes  
- **Message Viewer** (`view_messages`): Can only view contact messages
- **Message Manager** (`manage_messages`): Can view and mark messages as read
- **Volunteers Viewer** (`viewer_volunteers`): Can only view volunteer projects and applications
- **Volunteers Manager** (`manage_volunteers`): Can create projects, approve/reject applications
- **Super Admin** (`super_admin`): Has all permissions

## Files Modified

### Controllers:
- `app/Http/Controllers/AdminDonationController.php`
- `app/Http/Controllers/CauseController.php`
- `app/Http/Controllers/ContactController.php`
- `app/Http/Controllers/VolunteeringController.php`

### Views:
- `resources/views/admin/donations/index.blade.php`
- `resources/views/admin/donations/show.blade.php`
- `resources/views/admin/messages/index.blade.php`

### Routes:
The routes in `routes/web.php` already had proper middleware protection with the `permission:` middleware.

## How It Works

1. **Backend Protection**: Each management action checks if the authenticated admin has the required permission using `auth('admin')->user()->hasPermission('permission_name')`

2. **Frontend Protection**: View files check permissions before displaying action buttons, forms, or interactive elements

3. **Error Handling**: Users without proper permissions receive 403 errors or appropriate error messages

4. **Role Inheritance**: Super admins automatically have all permissions

## Testing

To test the permission system:

1. Create test admin users with different role combinations
2. Log in with each user type  
3. Verify that:
   - Viewers can only see data, not modify it
   - Managers can both view and modify data
   - Action buttons are hidden/shown appropriately
   - Backend endpoints return 403 for unauthorized actions

## UX Improvements

**Better User Experience with Grayed-Out Buttons:**
- Instead of completely hiding buttons from users without permissions, buttons are now:
  - Visually present but disabled
  - Grayed out with reduced opacity
  - Include helpful tooltips explaining the permission requirement
  - Use `cursor-not-allowed` to indicate the button is not clickable

**Benefits:**
- Users understand what functionality exists in the system
- Clear visual feedback about their permission level
- Reduces confusion about missing features
- Maintains consistent UI layout regardless of user permissions
- Tooltips provide educational value about required permissions

## Security Notes

- All permission checks are performed on the server-side
- Frontend restrictions are for UX only - backend validation is the real security
- Permission middleware is already in place on routes
- Super admin role maintains full access to everything
