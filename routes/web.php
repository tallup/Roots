<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

// Admin Routes (Custom)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/login');
    });
    
    Route::get('/login', [App\Http\Controllers\AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('login.post');
    Route::get('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
    
    // Password reset
    Route::get('/reset-password', [App\Http\Controllers\AdminController::class, 'showResetPassword'])->name('reset-password');
    Route::post('/reset-password', [App\Http\Controllers\AdminController::class, 'resetPassword'])->name('reset-password.post');
    
    // Add Admin form
    Route::get('/add-admin', [App\Http\Controllers\AdminController::class, 'showAddAdmin'])->name('add-admin');
    Route::post('/add-admin', [App\Http\Controllers\AdminController::class, 'storeAddAdmin'])->name('add-admin.store');

    // Add Supervisor form
    Route::get('/add-supervisor', [App\Http\Controllers\AdminController::class, 'showAddSupervisor'])->name('add-supervisor');
    Route::post('/add-supervisor', [App\Http\Controllers\AdminController::class, 'storeAddSupervisor'])->name('add-supervisor.store');

    // Add Finance form
    Route::get('/add-finance', [App\Http\Controllers\AdminController::class, 'showAddFinance'])->name('add-finance');
    Route::post('/add-finance', [App\Http\Controllers\AdminController::class, 'storeAddFinance'])->name('add-finance.store');

    // Add Data Entry form
    Route::get('/add-dataentry', [App\Http\Controllers\AdminController::class, 'showAddDataEntry'])->name('add-dataentry');
    Route::post('/add-dataentry', [App\Http\Controllers\AdminController::class, 'storeAddDataEntry'])->name('add-dataentry.store');

    // Contract Types
    Route::get('/contract-types', [App\Http\Controllers\AdminController::class, 'showContractTypes'])->name('contract-types');
    Route::get('/add-contract-type', [App\Http\Controllers\AdminController::class, 'showAddContractType'])->name('add-contract-type');
    Route::post('/add-contract-type', [App\Http\Controllers\AdminController::class, 'storeAddContractType'])->name('add-contract-type.store');
    Route::get('/edit-contract-type/{id}', [App\Http\Controllers\AdminController::class, 'showEditContractType'])->name('edit-contract-type');
    Route::post('/edit-contract-type/{id}', [App\Http\Controllers\AdminController::class, 'updateContractType'])->name('edit-contract-type.update');
    Route::delete('/delete-contract-type/{id}', [App\Http\Controllers\AdminController::class, 'deleteContractType'])->name('delete-contract-type');

    // Indicator Types
    Route::get('/indicator-types', [App\Http\Controllers\AdminController::class, 'showIndicatorTypes'])->name('indicator-types');
    Route::get('/add-indicator-type', [App\Http\Controllers\AdminController::class, 'showAddIndicatorType'])->name('add-indicator-type');
    Route::post('/add-indicator-type', [App\Http\Controllers\AdminController::class, 'storeAddIndicatorType'])->name('add-indicator-type.store');
    Route::get('/edit-indicator-type/{id}', [App\Http\Controllers\AdminController::class, 'showEditIndicatorType'])->name('edit-indicator-type');
    Route::post('/edit-indicator-type/{id}', [App\Http\Controllers\AdminController::class, 'updateIndicatorType'])->name('edit-indicator-type.update');
    Route::delete('/delete-indicator-type/{id}', [App\Http\Controllers\AdminController::class, 'deleteIndicatorType'])->name('delete-indicator-type');

    // Indicator Descriptions
    Route::get('/indicator-descriptions', [App\Http\Controllers\AdminController::class, 'showIndicatorDescriptions'])->name('indicator-descriptions');
    Route::get('/add-indicator-description', [App\Http\Controllers\AdminController::class, 'showAddIndicatorDescription'])->name('add-indicator-description');
    Route::post('/add-indicator-description', [App\Http\Controllers\AdminController::class, 'storeAddIndicatorDescription'])->name('add-indicator-description.store');
    Route::get('/edit-indicator-description/{id}', [App\Http\Controllers\AdminController::class, 'showEditIndicatorDescription'])->name('edit-indicator-description');
    Route::post('/edit-indicator-description/{id}', [App\Http\Controllers\AdminController::class, 'updateIndicatorDescription'])->name('edit-indicator-description.update');
    Route::delete('/delete-indicator-description/{id}', [App\Http\Controllers\AdminController::class, 'deleteIndicatorDescription'])->name('delete-indicator-description');

    // Intervention Types
    Route::get('/intervention-types', [App\Http\Controllers\AdminController::class, 'showInterventionTypes'])->name('intervention-types');
    Route::get('/add-intervention-type', [App\Http\Controllers\AdminController::class, 'showAddInterventionType'])->name('add-intervention-type');
    Route::post('/add-intervention-type', [App\Http\Controllers\AdminController::class, 'storeAddInterventionType'])->name('add-intervention-type.store');
    Route::get('/edit-intervention-type/{id}', [App\Http\Controllers\AdminController::class, 'showEditInterventionType'])->name('edit-intervention-type');
    Route::post('/edit-intervention-type/{id}', [App\Http\Controllers\AdminController::class, 'updateInterventionType'])->name('edit-intervention-type.update');
    Route::delete('/delete-intervention-type/{id}', [App\Http\Controllers\AdminController::class, 'deleteInterventionType'])->name('delete-intervention-type');

    // Training Types
    Route::get('/training-types', [App\Http\Controllers\AdminController::class, 'showTrainingTypes'])->name('training-types');
    Route::get('/add-training-type', [App\Http\Controllers\AdminController::class, 'showAddTrainingType'])->name('add-training-type');
    Route::post('/add-training-type', [App\Http\Controllers\AdminController::class, 'storeAddTrainingType'])->name('add-training-type.store');
    Route::get('/edit-training-type/{id}', [App\Http\Controllers\AdminController::class, 'showEditTrainingType'])->name('edit-training-type');
    Route::post('/edit-training-type/{id}', [App\Http\Controllers\AdminController::class, 'updateTrainingType'])->name('edit-training-type.update');
    Route::delete('/delete-training-type/{id}', [App\Http\Controllers\AdminController::class, 'deleteTrainingType'])->name('delete-training-type');
    Route::get('/training-types-report', [App\Http\Controllers\AdminController::class, 'showTrainingTypesReport'])->name('training-types-report');

    // Beneficiary Types
    Route::get('/beneficiary-types', [App\Http\Controllers\AdminController::class, 'showBeneficiaryTypes'])->name('beneficiary-types');
    Route::get('/add-beneficiary-type', [App\Http\Controllers\AdminController::class, 'showAddBeneficiaryType'])->name('add-beneficiary-type');
    Route::post('/add-beneficiary-type', [App\Http\Controllers\AdminController::class, 'storeAddBeneficiaryType'])->name('add-beneficiary-type.store');
    Route::get('/edit-beneficiary-type/{id}', [App\Http\Controllers\AdminController::class, 'showEditBeneficiaryType'])->name('edit-beneficiary-type');
    Route::post('/edit-beneficiary-type/{id}', [App\Http\Controllers\AdminController::class, 'updateBeneficiaryType'])->name('edit-beneficiary-type.update');
    Route::delete('/delete-beneficiary-type/{id}', [App\Http\Controllers\AdminController::class, 'deleteBeneficiaryType'])->name('delete-beneficiary-type');
    Route::get('/beneficiary-types-report', [App\Http\Controllers\AdminController::class, 'showBeneficiaryTypesReport'])->name('beneficiary-types-report');

    // Contract Types Report
    
    // Quality Checks - Indicator Performance Tracking
    Route::get('/indicator-performance', [App\Http\Controllers\AdminController::class, 'showIndicatorPerformance'])->name('indicator-performance');
    Route::get('/indicator-performance/{id}/review', [App\Http\Controllers\AdminController::class, 'showIndicatorPerformanceReview'])->name('indicator-performance.review');
    Route::post('/indicator-performance/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveIndicatorPerformance'])->name('indicator-performance.approve');
    Route::post('/indicator-performance/{id}/update', [App\Http\Controllers\AdminController::class, 'updateIndicatorPerformance'])->name('indicator-performance.update');
    Route::post('/indicator-performance/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteIndicatorPerformance'])->name('indicator-performance.delete');

    // Beneficiary Performance Tracking
    Route::get('/beneficiary-performance', [App\Http\Controllers\AdminController::class, 'showBeneficiaryPerformance'])->name('beneficiary-performance');
    Route::get('/beneficiary-performance/{id}/review', [App\Http\Controllers\AdminController::class, 'showBeneficiaryPerformanceReview'])->name('beneficiary-performance.review');
    Route::post('/beneficiary-performance/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveBeneficiaryPerformance'])->name('beneficiary-performance.approve');
    Route::post('/beneficiary-performance/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectBeneficiaryPerformance'])->name('beneficiary-performance.reject');
    Route::post('/beneficiary-performance/{id}/update', [App\Http\Controllers\AdminController::class, 'updateBeneficiaryPerformance'])->name('beneficiary-performance.update');
    Route::post('/beneficiary-performance/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteBeneficiaryPerformance'])->name('beneficiary-performance.delete');

    // Disbursement Performance Tracking
    Route::get('/disbursement-performance', [App\Http\Controllers\AdminController::class, 'showDisbursementPerformance'])->name('disbursement-performance');
    Route::get('/disbursement-performance/{id}/review', [App\Http\Controllers\AdminController::class, 'showDisbursementPerformanceReview'])->name('disbursement-performance.review');
    Route::post('/disbursement-performance/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveDisbursementPerformance'])->name('disbursement-performance.approve');
    Route::post('/disbursement-performance/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectDisbursementPerformance'])->name('disbursement-performance.reject');
    Route::post('/disbursement-performance/{id}/update', [App\Http\Controllers\AdminController::class, 'updateDisbursementPerformance'])->name('disbursement-performance.update');
    Route::post('/disbursement-performance/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteDisbursementPerformance'])->name('disbursement-performance.delete');

    // Contract/MOU Performance Tracking
    Route::get('/contract-performance', [App\Http\Controllers\AdminController::class, 'showContractPerformance'])->name('contract-performance');
    Route::get('/contract-performance/{id}/review', [App\Http\Controllers\AdminController::class, 'showContractPerformanceReview'])->name('contract-performance.review');
    Route::post('/contract-performance/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveContractPerformance'])->name('contract-performance.approve');
    Route::post('/contract-performance/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectContractPerformance'])->name('contract-performance.reject');
    Route::post('/contract-performance/{id}/update', [App\Http\Controllers\AdminController::class, 'updateContractPerformance'])->name('contract-performance.update');
    Route::post('/contract-performance/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteContractPerformance'])->name('contract-performance.delete');

// Training Performance Routes
Route::get('/training-performance', [App\Http\Controllers\AdminController::class, 'showTrainingPerformance'])->name('training-performance');
Route::get('/training-performance/{id}/review', [App\Http\Controllers\AdminController::class, 'showTrainingPerformanceReview'])->name('training-performance.review');
Route::post('/training-performance/{id}/approve', [App\Http\Controllers\AdminController::class, 'approveTrainingPerformance'])->name('training-performance.approve');
Route::post('/training-performance/{id}/reject', [App\Http\Controllers\AdminController::class, 'rejectTrainingPerformance'])->name('training-performance.reject');
    Route::post('/training-performance/{id}/update', [App\Http\Controllers\AdminController::class, 'updateTrainingPerformance'])->name('training-performance.update');
    Route::post('/training-performance/{id}/delete', [App\Http\Controllers\AdminController::class, 'deleteTrainingPerformance'])->name('training-performance.delete');

    // General Reports
    Route::get('/beneficiaries-new', [App\Http\Controllers\AdminController::class, 'showBeneficiariesNew'])->name('beneficiaries-new');
    Route::get('/indicators', [App\Http\Controllers\AdminController::class, 'showIndicators'])->name('indicators');
    Route::get('/contracts', [App\Http\Controllers\AdminController::class, 'showContracts'])->name('contracts');
    Route::get('/trainings', [App\Http\Controllers\AdminController::class, 'showTrainings'])->name('trainings');

// Public Analytics Route
Route::get('/analytics', [App\Http\Controllers\PublicController::class, 'showAnalytics'])->name('public.analytics');
    Route::get('/contract-types-report', [App\Http\Controllers\AdminController::class, 'showContractTypesReport'])->name('contract-types-report');

    // Indicator Types Report
    Route::get('/indicator-types-report', [App\Http\Controllers\AdminController::class, 'showIndicatorTypesReport'])->name('indicator-types-report');

    // Indicator Descriptions Report
    Route::get('/indicator-descriptions-report', [App\Http\Controllers\AdminController::class, 'showIndicatorDescriptionsReport'])->name('indicator-descriptions-report');

    // Intervention Types Report
    Route::get('/intervention-types-report', [App\Http\Controllers\AdminController::class, 'showInterventionTypesReport'])->name('intervention-types-report');

    // Implementing Partners
    Route::get('/implementing-partners', [App\Http\Controllers\AdminController::class, 'showImplementingPartners'])->name('implementing-partners');
    Route::get('/imp-partners', function() {
        return redirect()->route('admin.implementing-partners');
    })->name('imp-partners');
    Route::get('/add-implementing-partner', [App\Http\Controllers\AdminController::class, 'showAddImplementingPartner'])->name('add-implementing-partner');
    Route::post('/add-implementing-partner', [App\Http\Controllers\AdminController::class, 'storeAddImplementingPartner'])->name('add-implementing-partner.store');
    Route::get('/edit-implementing-partner/{id}', [App\Http\Controllers\AdminController::class, 'showEditImplementingPartner'])->name('edit-implementing-partner');
    Route::post('/edit-implementing-partner/{id}', [App\Http\Controllers\AdminController::class, 'updateImplementingPartner'])->name('edit-implementing-partner.update');
    Route::delete('/delete-implementing-partner/{id}', [App\Http\Controllers\AdminController::class, 'deleteImplementingPartner'])->name('delete-implementing-partner');
    Route::get('/implementing-partners-report', [App\Http\Controllers\AdminController::class, 'showImplementingPartnersReport'])->name('implementing-partners-report');

    // Regions
    Route::get('/regions', [App\Http\Controllers\AdminController::class, 'showRegions'])->name('regions');
    Route::get('/add-region', [App\Http\Controllers\AdminController::class, 'showAddRegion'])->name('add-region');
    Route::post('/add-region', [App\Http\Controllers\AdminController::class, 'storeAddRegion'])->name('add-region.store');
    Route::get('/edit-region/{id}', [App\Http\Controllers\AdminController::class, 'showEditRegion'])->name('edit-region');
    Route::post('/edit-region/{id}', [App\Http\Controllers\AdminController::class, 'updateRegion'])->name('edit-region.update');
    Route::delete('/delete-region/{id}', [App\Http\Controllers\AdminController::class, 'deleteRegion'])->name('delete-region');
    Route::get('/regions-report', [App\Http\Controllers\AdminController::class, 'showRegionsReport'])->name('regions-report');

    // Activities
    Route::get('/activities', [App\Http\Controllers\AdminController::class, 'showActivities'])->name('activities');
    Route::get('/add-activity', [App\Http\Controllers\AdminController::class, 'showAddActivity'])->name('add-activity');
    Route::post('/add-activity', [App\Http\Controllers\AdminController::class, 'storeAddActivity'])->name('add-activity.store');
    Route::get('/edit-activity/{id}', [App\Http\Controllers\AdminController::class, 'showEditActivity'])->name('edit-activity');
    Route::post('/edit-activity/{id}', [App\Http\Controllers\AdminController::class, 'updateActivity'])->name('edit-activity.update');
    Route::delete('/delete-activity/{id}', [App\Http\Controllers\AdminController::class, 'deleteActivity'])->name('delete-activity');
    Route::get('/activities-report', [App\Http\Controllers\AdminController::class, 'showActivitiesReport'])->name('activities-report');

    // Indicator Reporting Frequencies
    Route::get('/indicator-frequencies', [App\Http\Controllers\AdminController::class, 'showIndicatorFrequencies'])->name('indicator-frequencies');
    Route::get('/add-indicator-frequency', [App\Http\Controllers\AdminController::class, 'showAddIndicatorFrequency'])->name('add-indicator-frequency');
    Route::post('/add-indicator-frequency', [App\Http\Controllers\AdminController::class, 'storeAddIndicatorFrequency'])->name('add-indicator-frequency.store');
    Route::get('/edit-indicator-frequency/{id}', [App\Http\Controllers\AdminController::class, 'showEditIndicatorFrequency'])->name('edit-indicator-frequency');
    Route::post('/edit-indicator-frequency/{id}', [App\Http\Controllers\AdminController::class, 'updateIndicatorFrequency'])->name('edit-indicator-frequency.update');
    Route::delete('/delete-indicator-frequency/{id}', [App\Http\Controllers\AdminController::class, 'deleteIndicatorFrequency'])->name('delete-indicator-frequency');
    Route::get('/indicator-frequencies-report', [App\Http\Controllers\AdminController::class, 'showIndicatorFrequenciesReport'])->name('indicator-frequencies-report');

    // Activities Status
    Route::get('/activity-status', [App\Http\Controllers\AdminController::class, 'showActivityStatus'])->name('activity-status');
    Route::get('/add-activity-status', [App\Http\Controllers\AdminController::class, 'showAddActivityStatus'])->name('add-activity-status');
    Route::post('/add-activity-status', [App\Http\Controllers\AdminController::class, 'storeAddActivityStatus'])->name('add-activity-status.store');
    Route::get('/edit-activity-status/{id}', [App\Http\Controllers\AdminController::class, 'showEditActivityStatus'])->name('edit-activity-status');
    Route::post('/edit-activity-status/{id}', [App\Http\Controllers\AdminController::class, 'updateActivityStatus'])->name('edit-activity-status.update');
    Route::delete('/delete-activity-status/{id}', [App\Http\Controllers\AdminController::class, 'deleteActivityStatus'])->name('delete-activity-status');
    Route::get('/activity-status-report', [App\Http\Controllers\AdminController::class, 'showActivityStatusReport'])->name('activity-status-report');

    // Units Measurement
    Route::get('/units-measurement', [App\Http\Controllers\AdminController::class, 'showUnitsMeasurement'])->name('units-measurement');
    Route::get('/add-unit-measurement', [App\Http\Controllers\AdminController::class, 'showAddUnitMeasurement'])->name('add-unit-measurement');
    Route::post('/add-unit-measurement', [App\Http\Controllers\AdminController::class, 'storeAddUnitMeasurement'])->name('add-unit-measurement.store');
    Route::get('/edit-unit-measurement/{id}', [App\Http\Controllers\AdminController::class, 'showEditUnitMeasurement'])->name('edit-unit-measurement');
    Route::match(['PUT', 'PATCH'], '/edit-unit-measurement/{id}', [App\Http\Controllers\AdminController::class, 'updateUnitMeasurement'])->name('edit-unit-measurement.update');
    Route::delete('/delete-unit-measurement/{id}', [App\Http\Controllers\AdminController::class, 'deleteUnitMeasurement'])->name('delete-unit-measurement');
    Route::get('/units-measurement-report', [App\Http\Controllers\AdminController::class, 'showUnitsMeasurementReport'])->name('units-measurement-report');

    // Persons
    Route::get('/persons', [App\Http\Controllers\AdminController::class, 'showPersons'])->name('persons');
    Route::get('/add-person', [App\Http\Controllers\AdminController::class, 'showAddPerson'])->name('add-person');
    Route::post('/add-person', [App\Http\Controllers\AdminController::class, 'storeAddPerson'])->name('add-person.store');
    Route::get('/edit-person/{id}', [App\Http\Controllers\AdminController::class, 'showEditPerson'])->name('edit-person');
    Route::match(['PUT', 'PATCH'], '/edit-person/{id}', [App\Http\Controllers\AdminController::class, 'updatePerson'])->name('edit-person.update');
    Route::delete('/delete-person/{id}', [App\Http\Controllers\AdminController::class, 'deletePerson'])->name('delete-person');
    Route::get('/persons-report', [App\Http\Controllers\AdminController::class, 'showPersonsReport'])->name('persons-report');

    // Contractors
    Route::get('/contractors', [App\Http\Controllers\AdminController::class, 'showContractors'])->name('contractors');
    Route::get('/add-contractor', [App\Http\Controllers\AdminController::class, 'showAddContractor'])->name('add-contractor');
    Route::post('/add-contractor', [App\Http\Controllers\AdminController::class, 'storeAddContractor'])->name('add-contractor.store');
    Route::get('/edit-contractor/{id}', [App\Http\Controllers\AdminController::class, 'showEditContractor'])->name('edit-contractor');
    Route::match(['PUT', 'PATCH'], '/edit-contractor/{id}', [App\Http\Controllers\AdminController::class, 'updateContractor'])->name('edit-contractor.update');
    Route::delete('/delete-contractor/{id}', [App\Http\Controllers\AdminController::class, 'deleteContractor'])->name('delete-contractor');
    Route::get('/contractors-report', [App\Http\Controllers\AdminController::class, 'showContractorsReport'])->name('contractors-report');

    // Venues
    Route::get('/venue', [App\Http\Controllers\AdminController::class, 'showVenues'])->name('venues');
    Route::get('/add-venue', [App\Http\Controllers\AdminController::class, 'showAddVenue'])->name('add-venue');
    Route::post('/add-venue', [App\Http\Controllers\AdminController::class, 'storeAddVenue'])->name('add-venue.store');
    Route::get('/edit-venue/{id}', [App\Http\Controllers\AdminController::class, 'showEditVenue'])->name('edit-venue');
    Route::match(['PUT', 'PATCH'], '/edit-venue/{id}', [App\Http\Controllers\AdminController::class, 'updateVenue'])->name('edit-venue.update');
    Route::delete('/delete-venue/{id}', [App\Http\Controllers\AdminController::class, 'deleteVenue'])->name('delete-venue');
    Route::get('/venues-report', [App\Http\Controllers\AdminController::class, 'showVenuesReport'])->name('venues-report');

    // Payment Modes
    Route::get('/payment-modes', [App\Http\Controllers\AdminController::class, 'showPaymentModes'])->name('payment-modes');
    Route::get('/add-payment-mode', [App\Http\Controllers\AdminController::class, 'showAddPaymentMode'])->name('add-payment-mode');
    Route::post('/add-payment-mode', [App\Http\Controllers\AdminController::class, 'storeAddPaymentMode'])->name('add-payment-mode.store');
    Route::get('/edit-payment-mode/{id}', [App\Http\Controllers\AdminController::class, 'showEditPaymentMode'])->name('edit-payment-mode');
    Route::match(['PUT', 'PATCH'], '/edit-payment-mode/{id}', [App\Http\Controllers\AdminController::class, 'updatePaymentMode'])->name('edit-payment-mode.update');
    Route::delete('/delete-payment-mode/{id}', [App\Http\Controllers\AdminController::class, 'deletePaymentMode'])->name('delete-payment-mode');
    Route::get('/payment-modes-report', [App\Http\Controllers\AdminController::class, 'showPaymentModesReport'])->name('payment-modes-report');

    // Payment Tranches
    Route::get('/payment-tranches', [App\Http\Controllers\AdminController::class, 'showPaymentTranches'])->name('payment-tranches');
    Route::get('/add-payment-tranche', [App\Http\Controllers\AdminController::class, 'showAddPaymentTranche'])->name('add-payment-tranche');
    Route::post('/add-payment-tranche', [App\Http\Controllers\AdminController::class, 'storeAddPaymentTranche'])->name('add-payment-tranche.store');
    Route::get('/edit-payment-tranche/{id}', [App\Http\Controllers\AdminController::class, 'showEditPaymentTranche'])->name('edit-payment-tranche');
    Route::match(['PUT', 'PATCH'], '/edit-payment-tranche/{id}', [App\Http\Controllers\AdminController::class, 'updatePaymentTranche'])->name('edit-payment-tranche.update');
    Route::delete('/delete-payment-tranche/{id}', [App\Http\Controllers\AdminController::class, 'deletePaymentTranche'])->name('delete-payment-tranche');
    Route::get('/payment-tranches-report', [App\Http\Controllers\AdminController::class, 'showPaymentTranchesReport'])->name('payment-tranches-report');

    // Project Frequencies
    Route::get('/project-frequencies', [App\Http\Controllers\AdminController::class, 'showProjectFrequencies'])->name('project-frequencies');
    Route::get('/add-project-frequency', [App\Http\Controllers\AdminController::class, 'showAddProjectFrequency'])->name('add-project-frequency');
    Route::post('/add-project-frequency', [App\Http\Controllers\AdminController::class, 'storeAddProjectFrequency'])->name('add-project-frequency.store');
    Route::get('/edit-project-frequency/{id}', [App\Http\Controllers\AdminController::class, 'showEditProjectFrequency'])->name('edit-project-frequency');
    Route::match(['PUT', 'PATCH'], '/edit-project-frequency/{id}', [App\Http\Controllers\AdminController::class, 'updateProjectFrequency'])->name('edit-project-frequency.update');
    Route::delete('/delete-project-frequency/{id}', [App\Http\Controllers\AdminController::class, 'deleteProjectFrequency'])->name('delete-project-frequency');
    Route::get('/project-frequencies-report', [App\Http\Controllers\AdminController::class, 'showProjectFrequenciesReport'])->name('project-frequencies-report');

    // Components
    Route::get('/components', [App\Http\Controllers\AdminController::class, 'showComponents'])->name('components');
    Route::get('/add-component', [App\Http\Controllers\AdminController::class, 'showAddComponent'])->name('add-component');
    Route::post('/add-component', [App\Http\Controllers\AdminController::class, 'storeAddComponent'])->name('add-component.store');
    Route::get('/edit-component/{id}', [App\Http\Controllers\AdminController::class, 'showEditComponent'])->name('edit-component');
    Route::match(['PUT', 'PATCH'], '/edit-component/{id}', [App\Http\Controllers\AdminController::class, 'updateComponent'])->name('edit-component.update');
    Route::delete('/delete-component/{id}', [App\Http\Controllers\AdminController::class, 'deleteComponent'])->name('delete-component');
    Route::get('/components-report', [App\Http\Controllers\AdminController::class, 'showComponentsReport'])->name('components-report');

    // Sub-Components
    Route::get('/sub-components', [App\Http\Controllers\AdminController::class, 'showSubComponents'])->name('sub-components');
    Route::get('/add-sub-component', [App\Http\Controllers\AdminController::class, 'showAddSubComponent'])->name('add-sub-component');
    Route::post('/add-sub-component', [App\Http\Controllers\AdminController::class, 'storeAddSubComponent'])->name('add-sub-component.store');
    Route::get('/edit-sub-component/{id}', [App\Http\Controllers\AdminController::class, 'showEditSubComponent'])->name('edit-sub-component');
    Route::match(['PUT', 'PATCH'], '/edit-sub-component/{id}', [App\Http\Controllers\AdminController::class, 'updateSubComponent'])->name('edit-sub-component.update');
    Route::delete('/delete-sub-component/{id}', [App\Http\Controllers\AdminController::class, 'deleteSubComponent'])->name('delete-sub-component');
    Route::get('/sub-components-report', [App\Http\Controllers\AdminController::class, 'showSubComponentsReport'])->name('sub-components-report');

    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    });
    Route::get('/test-sidebar', function () {
        return view('test-sidebar');
    });
});

// Data Entry Routes
Route::prefix('data-entry')->name('dataentry.')->group(function () {
    Route::get('/', function () {
        return redirect('/data-entry/login');
    });
    
    Route::get('/login', [App\Http\Controllers\DataEntryController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\DataEntryController::class, 'login'])->name('login.post');
    Route::get('/logout', [App\Http\Controllers\DataEntryController::class, 'logout'])->name('logout');
    
    // Password reset
    Route::get('/reset-password', [App\Http\Controllers\DataEntryController::class, 'showResetPassword'])->name('reset-password');
    Route::post('/reset-password', [App\Http\Controllers\DataEntryController::class, 'resetPassword'])->name('reset-password.post');

    // AJAX route for subcomponents (move outside auth)
    Route::post('/get-subcomponents', [App\Http\Controllers\DataEntryController::class, 'getSubcomponents'])->name('get-subcomponents');
    Route::post('/get-subcomponents-training', [App\Http\Controllers\DataEntryController::class, 'getSubcomponents'])->name('get-subcomponents-training');

    // Protected data entry routes
    Route::middleware('dataentry.auth')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\DataEntryController::class, 'dashboard'])->name('dashboard');
        
        // Beneficiary routes
        Route::get('/beneficiaries', [App\Http\Controllers\DataEntryController::class, 'showBeneficiaries'])->name('beneficiaries');
        Route::get('/add-beneficiary', [App\Http\Controllers\DataEntryController::class, 'showAddBeneficiary'])->name('add-beneficiary');
        Route::post('/add-beneficiary', [App\Http\Controllers\DataEntryController::class, 'storeAddBeneficiary'])->name('add-beneficiary.store');
        Route::get('/edit-beneficiary/{id}', [App\Http\Controllers\DataEntryController::class, 'showEditBeneficiary'])->name('edit-beneficiary');
        Route::post('/edit-beneficiary/{id}', [App\Http\Controllers\DataEntryController::class, 'updateBeneficiary'])->name('edit-beneficiary.update');
        
        // AJAX routes for dropdowns
        Route::post('/get-indicator-descriptions', [App\Http\Controllers\DataEntryController::class, 'getIndicatorDescriptions'])->name('get-indicator-descriptions');
        
        // View beneficiary
        Route::post('/view-beneficiary', [App\Http\Controllers\DataEntryController::class, 'viewBeneficiary'])->name('view-beneficiary');
        
        // Indicator routes
        Route::get('/indicators', [App\Http\Controllers\DataEntryController::class, 'showIndicators'])->name('indicators');
        Route::get('/add-indicator', [App\Http\Controllers\DataEntryController::class, 'showAddIndicator'])->name('add-indicator');
        Route::post('/add-indicator', [App\Http\Controllers\DataEntryController::class, 'storeAddIndicator'])->name('add-indicator.store');
        Route::get('/edit-indicator/{id}', [App\Http\Controllers\DataEntryController::class, 'showEditIndicator'])->name('edit-indicator');
        Route::match(['PUT', 'PATCH'], '/edit-indicator/{id}', [App\Http\Controllers\DataEntryController::class, 'updateIndicator'])->name('edit-indicator.update');
        Route::post('/view-indicator', [App\Http\Controllers\DataEntryController::class, 'viewIndicator'])->name('view-indicator');
        
        // AJAX routes for indicator dropdowns
        Route::post('/get-indicator-descriptions-by-type', [App\Http\Controllers\DataEntryController::class, 'getIndicatorDescriptionsByType'])->name('get-indicator-descriptions-by-type');

        // Contract routes (fixed paths)
        Route::get('/contracts', [App\Http\Controllers\DataEntryController::class, 'showContracts'])->name('contracts');
        Route::post('/contracts/view', [App\Http\Controllers\DataEntryController::class, 'viewContract'])->name('view-contract');
        Route::get('/contracts/add', [App\Http\Controllers\DataEntryController::class, 'showAddContract'])->name('add-contract');
        Route::post('/contracts/add', [App\Http\Controllers\DataEntryController::class, 'storeAddContract'])->name('add-contract.store');
        Route::get('/contracts/{id}/edit', [App\Http\Controllers\DataEntryController::class, 'showEditContract'])->name('edit-contract');
        Route::post('/contracts/{id}/edit', [App\Http\Controllers\DataEntryController::class, 'updateContract'])->name('edit-contract.update');

        // Training routes
        Route::get('/trainings', [App\Http\Controllers\DataEntryController::class, 'showTrainings'])->name('trainings');
        Route::post('/trainings/view', [App\Http\Controllers\DataEntryController::class, 'viewTraining'])->name('view-training');
        Route::get('/trainings/{id}/edit', [App\Http\Controllers\DataEntryController::class, 'showEditTraining'])->name('edit-training');
        Route::post('/trainings/{id}/edit', [App\Http\Controllers\DataEntryController::class, 'updateTraining'])->name('edit-training.update');
        Route::get('/trainings/add', [App\Http\Controllers\DataEntryController::class, 'showAddTraining'])->name('add-training');
        Route::post('/trainings/add', [App\Http\Controllers\DataEntryController::class, 'storeAddTraining'])->name('add-training.store');
        Route::get('/profile', [App\Http\Controllers\DataEntryController::class, 'showProfile'])->name('profile');
        Route::get('/settings', [App\Http\Controllers\DataEntryController::class, 'showSettings'])->name('settings');
        Route::post('/settings', [App\Http\Controllers\DataEntryController::class, 'updateSettings'])->name('settings.update');
    });
});

// Supervisor routes
Route::get('/supervisor/login', [\App\Http\Controllers\SupervisorController::class, 'showLogin'])->name('supervisor.login');
Route::post('/supervisor/login', [\App\Http\Controllers\SupervisorController::class, 'login'])->name('supervisor.login');
Route::post('/supervisor/logout', [\App\Http\Controllers\SupervisorController::class, 'logout'])->name('supervisor.logout');
Route::get('/supervisor/dashboard', [\App\Http\Controllers\SupervisorController::class, 'dashboard'])->name('supervisor.dashboard');
Route::get('/supervisor/forgot-password', [\App\Http\Controllers\SupervisorController::class, 'showForgotPassword'])->name('supervisor.forgot-password');
Route::post('/supervisor/forgot-password', [\App\Http\Controllers\SupervisorController::class, 'handleForgotPassword'])->name('supervisor.forgot-password');
Route::get('/supervisor/reset-password', [\App\Http\Controllers\SupervisorController::class, 'showResetPassword'])->name('supervisor.reset-password');
Route::post('/supervisor/reset-password', [\App\Http\Controllers\SupervisorController::class, 'handleResetPassword'])->name('supervisor.reset-password');
Route::get('/supervisor/beneficiaries', [\App\Http\Controllers\SupervisorController::class, 'beneficiaries'])->name('supervisor.beneficiaries');
Route::get('/supervisor/beneficiaries/{profile_id}/review', [\App\Http\Controllers\SupervisorController::class, 'reviewBeneficiary'])->name('supervisor.beneficiaries.review');
Route::post('/supervisor/beneficiaries/{profile_id}/review', [\App\Http\Controllers\SupervisorController::class, 'submitReview'])->name('supervisor.beneficiaries.review.submit');
Route::get('/supervisor/indicators', [\App\Http\Controllers\SupervisorController::class, 'indicators'])->name('supervisor.indicators');
Route::get('/supervisor/indicators/{indicator_id}/review', [\App\Http\Controllers\SupervisorController::class, 'reviewIndicator'])->name('supervisor.indicators.review');
Route::post('/supervisor/indicators/{indicator_id}/review', [\App\Http\Controllers\SupervisorController::class, 'submitIndicatorReview'])->name('supervisor.indicators.review.submit');
// Supervisor Contract routes
Route::get('/supervisor/contracts', [App\Http\Controllers\SupervisorController::class, 'contracts'])->name('supervisor.contracts');
Route::get('/supervisor/contracts/{conId}/review', [App\Http\Controllers\SupervisorController::class, 'reviewContract'])->name('supervisor.contracts.review');
Route::post('/supervisor/contracts/{conId}/review', [App\Http\Controllers\SupervisorController::class, 'submitContractReview'])->name('supervisor.contracts.review.submit');
// Supervisor Training routes
Route::get('/supervisor/trainings', [App\Http\Controllers\SupervisorController::class, 'trainings'])->name('supervisor.trainings');
Route::get('/supervisor/trainings/{train_Id}/review', [App\Http\Controllers\SupervisorController::class, 'reviewTraining'])->name('supervisor.trainings.review');
Route::post('/supervisor/trainings/{train_Id}/review', [App\Http\Controllers\SupervisorController::class, 'submitTrainingReview'])->name('supervisor.trainings.review.submit');
Route::get('/supervisor/profile', [\App\Http\Controllers\SupervisorController::class, 'profile'])->name('supervisor.profile');
Route::get('/supervisor/settings', [\App\Http\Controllers\SupervisorController::class, 'settings'])->name('supervisor.settings');
Route::post('/supervisor/settings', [App\Http\Controllers\SupervisorController::class, 'updateSettings'])->name('supervisor.settings.update');

// Finance routes
Route::get('/finance/login', [App\Http\Controllers\FinanceController::class, 'showLogin'])->name('finance.login');
Route::post('/finance/login', [App\Http\Controllers\FinanceController::class, 'login'])->name('finance.login');
Route::post('/finance/logout', [App\Http\Controllers\FinanceController::class, 'logout'])->name('finance.logout');
Route::get('/finance/dashboard', [App\Http\Controllers\FinanceController::class, 'dashboard'])->name('finance.dashboard');

// Finance Component Allocation routes
Route::get('/finance/components', [App\Http\Controllers\FinanceController::class, 'components'])->name('finance.components');
Route::get('/finance/components/add', [App\Http\Controllers\FinanceController::class, 'showAddComponent'])->name('finance.components.add');
Route::post('/finance/components/add', [App\Http\Controllers\FinanceController::class, 'storeAddComponent'])->name('finance.components.store');
Route::get('/finance/components/report', [App\Http\Controllers\FinanceController::class, 'componentReport'])->name('finance.components.report');

// Finance Subcomponent Allocation routes
Route::get('/finance/subcomponents', [App\Http\Controllers\FinanceController::class, 'subcomponents'])->name('finance.subcomponents');
Route::get('/finance/subcomponents/add', [App\Http\Controllers\FinanceController::class, 'showAddSubcomponent'])->name('finance.subcomponents.add');
Route::post('/finance/subcomponents/add', [App\Http\Controllers\FinanceController::class, 'storeAddSubcomponent'])->name('finance.subcomponents.store');
Route::get('/finance/subcomponents/{id}/edit', [App\Http\Controllers\FinanceController::class, 'showEditSubcomponent'])->name('finance.subcomponents.edit');
Route::post('/finance/subcomponents/{id}/edit', [App\Http\Controllers\FinanceController::class, 'updateSubcomponent'])->name('finance.subcomponents.update');
Route::delete('/finance/subcomponents/{id}', [App\Http\Controllers\FinanceController::class, 'deleteSubcomponent'])->name('finance.subcomponents.delete');
Route::get('/finance/subcomponents/report', [App\Http\Controllers\FinanceController::class, 'subcomponentReport'])->name('finance.subcomponents.report');

Route::get('/finance/components/{id}/edit', [App\Http\Controllers\FinanceController::class, 'showEditComponent'])->name('finance.components.edit');
Route::post('/finance/components/{id}/edit', [App\Http\Controllers\FinanceController::class, 'updateComponent'])->name('finance.components.update');
Route::delete('/finance/components/{id}', [App\Http\Controllers\FinanceController::class, 'deleteComponent'])->name('finance.components.delete');

Route::prefix('finance')->group(function () {
    Route::resource('disbursements', App\Http\Controllers\FinanceDisbursementController::class, [
        'names' => [
            'index' => 'finance.disbursements.index',
            'create' => 'finance.disbursements.create',
            'store' => 'finance.disbursements.store',
            'edit' => 'finance.disbursements.edit',
            'update' => 'finance.disbursements.update',
            'destroy' => 'finance.disbursements.destroy',
        ]
    ]);
    Route::post('disbursements/load-subcomponents', [App\Http\Controllers\FinanceDisbursementController::class, 'loadSubcomponents'])->name('finance.disbursements.loadSubcomponents');
    Route::resource('result-transactions', App\Http\Controllers\FinanceResultTransactionController::class, [
        'only' => ['index', 'edit', 'update'],
        'names' => [
            'index' => 'finance.result-transactions.index',
            'edit' => 'finance.result-transactions.edit',
            'update' => 'finance.result-transactions.update',
        ]
    ]);
    Route::get('transaction-list', [App\Http\Controllers\FinanceTransactionListController::class, 'index'])->name('finance.transaction-list.index');
    Route::get('transaction-report', [App\Http\Controllers\FinanceTransactionReportController::class, 'index'])->name('finance.transaction-report.index');
});
