<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200418080423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE comment_comments (id UUID NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, author_id UUID NOT NULL, text TEXT NOT NULL, update_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, entity_type VARCHAR(255) NOT NULL, entity_id VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_42DAF52CAA9E377A ON comment_comments (date)');
        $this->addSql('CREATE INDEX IDX_42DAF52CC412EE0281257D5D ON comment_comments (entity_type, entity_id)');
        $this->addSql('COMMENT ON COLUMN comment_comments.date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN comment_comments.update_date IS \'(DC2Type:datetime_immutable)\'');
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
        $this->addSql('ALTER TABLE work_projects_projects ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_projects ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_projects_projects ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_members_members ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_members_members ALTER status DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_groups ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_groups ALTER id DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP TABLE comment_comments');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id TYPE UUID');
        $this->addSql('ALTER TABLE user_user_networks ALTER user_id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE user_users ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER new_email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE user_users ALTER new_email DROP DEFAULT');
        $this->addSql('ALTER TABLE user_users ALTER role TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE user_users ALTER role DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_groups ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_groups ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id TYPE UUID');
        $this->addSql('ALTER TABLE work_members_members ALTER group_id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER email TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work_members_members ALTER email DROP DEFAULT');
        $this->addSql('ALTER TABLE work_members_members ALTER status TYPE VARCHAR(16)');
        $this->addSql('ALTER TABLE work_members_members ALTER status DROP DEFAULT');
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
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
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
    }
}
