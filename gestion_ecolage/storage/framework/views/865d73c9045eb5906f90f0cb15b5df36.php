

<?php $__env->startSection('page-title', 'Liste des Étudiants'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .student-row {
        border-bottom: 1px solid #e5e7eb;
        transition: all 0.2s;
    }
    .student-row:nth-child(odd) {
        background: #fff;
    }
    .student-row:nth-child(even) {
        background: #fafafa;
    }
    .student-row:hover {
        background: #f9fafb !important;
        box-shadow: inset 0 0 0 1px rgba(79,70,229,0.1);
    }
</style>

<!-- Header Section -->
<div class="mb-8">
    <div style="background:linear-gradient(135deg,#4f46e5,#7c3aed);border-radius:12px;padding:32px;color:#fff;box-shadow:0 4px 12px rgba(79,70,229,0.15)">
        <div style="display:flex;justify-content:space-between;align-items:center">
            <div>
                <h2 style="margin:0;font-size:28px;font-weight:700">👥 Gestion des Étudiants</h2>
                <p style="margin:8px 0 0;opacity:0.9;font-size:15px">Gérez tous les étudiants du système</p>
            </div>
            <a href="<?php echo e(route('students.create')); ?>" 
               style="background:#fff;color:#4f46e5;padding:12px 24px;border-radius:8px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:all 0.3s;display:inline-block">
                ➕ Nouvel Étudiant
            </a>
        </div>
    </div>
</div>

<!-- Search & Filter -->
<div style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.08);margin-bottom:24px">
    <form method="GET" action="<?php echo e(route('students.index')); ?>" style="display:flex;gap:12px">
        <input type="text" name="search" placeholder="🔍 Rechercher par nom ou matricule..." 
               value="<?php echo e(request('search')); ?>"
               style="flex:1;padding:12px 16px;border:2px solid #e2e8f0;border-radius:8px;font-size:14px;transition:all 0.3s"
               onmouseover="this.style.borderColor='#4f46e5'" 
               onmouseout="this.style.borderColor='#e2e8f0'">
        <button type="submit" style="background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;padding:12px 24px;border-radius:8px;border:none;cursor:pointer;font-weight:600;transition:all 0.3s">
            🔎 Rechercher
        </button>
    </form>
</div>

<!-- Students Table -->
<div style="background:#fff;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,0.08);overflow:hidden">
    <div style="overflow-x:auto">
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="background:linear-gradient(135deg,#f3f4f6,#e5e7eb);border-bottom:2px solid #e5e7eb">
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Matricule</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Nom Complet</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Genre</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Classe</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Niveau</th>
                    <th style="padding:16px;text-align:left;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Parent</th>
                    <th style="padding:16px;text-align:center;font-size:13px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:0.5px">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="student-row" style="padding:16px">
                    <td style="padding:16px;font-size:13px;font-family:monospace;font-weight:600;color:#4f46e5"><?php echo e($student->registration_number); ?></td>
                    <td style="padding:16px;font-size:14px;font-weight:600;color:#1f2937"><?php echo e($student->full_name); ?></td>
                    <td style="padding:16px;font-size:13px">
                        <?php if($student->gender === 'M'): ?>
                            <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#dbeafe;color:#1e40af">
                                🧑‍💼 Masculin
                            </span>
                        <?php else: ?>
                            <span style="display:inline-flex;align-items:center;padding:6px 12px;border-radius:20px;font-size:12px;font-weight:600;background:#fce7f3;color:#be185d">
                                👩‍💼 Féminin
                            </span>
                        <?php endif; ?>
                    </td>
                    <td style="padding:16px;font-size:14px;color:#374151"><?php echo e($student->classroom->name); ?></td>
                    <td style="padding:16px;font-size:14px;color:#374151"><?php echo e($student->classroom->level->name); ?></td>
                    <td style="padding:16px;font-size:14px;color:#374151"><?php echo e($student->parent?->full_name ?? '-'); ?></td>
                    <td style="padding:16px;text-align:center">
                        <div style="display:flex;justify-content:center;gap:8px">
                            <a href="<?php echo e(route('students.show', $student)); ?>" 
                               style="padding:6px 12px;background:#dbeafe;color:#1e40af;text-decoration:none;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                               onmouseover="this.style.background='#93c5fd';this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='#dbeafe';this.style.transform='translateY(0)'">
                                👁️ Voir
                            </a>
                            <a href="<?php echo e(route('students.edit', $student)); ?>" 
                               style="padding:6px 12px;background:#fef08a;color:#92400e;text-decoration:none;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                               onmouseover="this.style.background='#fde047';this.style.transform='translateY(-2px)'"
                               onmouseout="this.style.background='#fef08a';this.style.transform='translateY(0)'">
                                ✏️ Éditer
                            </a>
                            <form method="POST" action="<?php echo e(route('students.destroy', $student)); ?>" 
                                  style="display:inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" style="padding:6px 12px;background:#fee2e2;color:#991b1b;border-radius:6px;font-size:12px;font-weight:600;transition:all 0.2s;border:none;cursor:pointer"
                                        onmouseover="this.style.background='#fecaca';this.style.transform='translateY(-2px)'"
                                        onmouseout="this.style.background='#fee2e2';this.style.transform='translateY(0)'">
                                    🗑️ Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" style="padding:48px 16px;text-align:center">
                        <div style="color:#9ca3af">
                            <p style="font-size:18px;margin:0;margin-bottom:8px">📭 Aucun étudiant trouvé</p>
                            <p style="font-size:13px;margin:0">Commencez par ajouter un nouvel étudiant</p>
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div style="margin-top:24px">
    <?php echo e($students->links('pagination::custom')); ?>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\gestion_ecolage\gestion_ecolage\resources\views/students/index.blade.php ENDPATH**/ ?>