<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422193059 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE user_users ADD version INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER role TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE user_users ALTER role DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER new_email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER new_email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE comment_comments ADD version INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE comment_comments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE comment_comments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE comment_comments ALTER author_id TYPE UUID');
        $this->addSql('ALTER TABLE comment_comments ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ADD version INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER author_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER parent_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER type DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER id TYPE INT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER actor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER actor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_file_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_file_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_removed_file_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_removed_file_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_type DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_status TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_parent_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_executor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_executor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_revoked_executor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_revoked_executor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ADD version INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ADD version INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ADD version INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE work_members_members ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_members_members ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_members_members ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_groups ADD version INT DEFAULT 1 NOT NULL');
        $this->addSql('ALTER TABLE work_members_groups ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_groups ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE user_user_networks ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users DROP version');
        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER new_email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER new_email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER role TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE user_users ALTER role DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_groups DROP version');
        $this->addSql('ALTER TABLE work_members_groups ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_groups ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members DROP version');
        $this->addSql('ALTER TABLE work_members_members ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_members_members ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_members_members ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects DROP version');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_departments ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ALTER department_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ALTER role_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles DROP version');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks DROP version');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER author_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER parent_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER type DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_tasks ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_tasks_executors ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER member_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_files ALTER member_id DROP DEFAULT');
        $this->addSql('ALTER TABLE comment_comments DROP version');
        $this->addSql('ALTER TABLE comment_comments ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE comment_comments ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE comment_comments ALTER author_id TYPE UUID');
        $this->addSql('ALTER TABLE comment_comments ALTER author_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER id TYPE INT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER task_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER task_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER actor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER actor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_project_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_project_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_file_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_file_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_removed_file_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_removed_file_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_type TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_type DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_status TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_parent_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_parent_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_executor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_executor_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_revoked_executor_id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_task_changes ALTER set_revoked_executor_id DROP DEFAULT');
    }
}
