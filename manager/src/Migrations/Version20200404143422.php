<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200404143422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE work_projects_project_membership (id UUID NOT NULL, project_id UUID NOT NULL, member_id UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_56161087166D1F9C ON work_projects_project_membership (project_id)');
        $this->addSql('CREATE INDEX IDX_561610877597D3FE ON work_projects_project_membership (member_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_56161087166D1F9C7597D3FE ON work_projects_project_membership (project_id, member_id)');
        $this->addSql('CREATE TABLE work_projects_project_membership_departments (membership_id UUID NOT NULL, department_id UUID NOT NULL, PRIMARY KEY(membership_id, department_id))');
        $this->addSql('CREATE INDEX IDX_D94281DD1FB354CD ON work_projects_project_membership_departments (membership_id)');
        $this->addSql('CREATE INDEX IDX_D94281DDAE80F5DF ON work_projects_project_membership_departments (department_id)');
        $this->addSql('CREATE TABLE work_projects_project_membership_roles (membership_id UUID NOT NULL, role_id UUID NOT NULL, PRIMARY KEY(membership_id, role_id))');
        $this->addSql('CREATE INDEX IDX_42102BF81FB354CD ON work_projects_project_membership_roles (membership_id)');
        $this->addSql('CREATE INDEX IDX_42102BF8D60322AC ON work_projects_project_membership_roles (role_id)');
        $this->addSql('ALTER TABLE work_projects_project_membership ADD CONSTRAINT FK_56161087166D1F9C FOREIGN KEY (project_id) REFERENCES work_projects_projects (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_project_membership ADD CONSTRAINT FK_561610877597D3FE FOREIGN KEY (member_id) REFERENCES work_members_members (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ADD CONSTRAINT FK_D94281DD1FB354CD FOREIGN KEY (membership_id) REFERENCES work_projects_project_membership (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_project_membership_departments ADD CONSTRAINT FK_D94281DDAE80F5DF FOREIGN KEY (department_id) REFERENCES work_projects_project_departments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ADD CONSTRAINT FK_42102BF81FB354CD FOREIGN KEY (membership_id) REFERENCES work_projects_project_membership (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles ADD CONSTRAINT FK_42102BF8D60322AC FOREIGN KEY (role_id) REFERENCES work_projects_roles (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
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

        $this->addSql('ALTER TABLE work_projects_project_membership_departments DROP CONSTRAINT FK_D94281DD1FB354CD');
        $this->addSql('ALTER TABLE work_projects_project_membership_roles DROP CONSTRAINT FK_42102BF81FB354CD');
        $this->addSql('DROP TABLE work_projects_project_membership');
        $this->addSql('DROP TABLE work_projects_project_membership_departments');
        $this->addSql('DROP TABLE work_projects_project_membership_roles');
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
        $this->addSql('ALTER TABLE work_projects_roles ALTER id TYPE UUID');
        $this->addSql('ALTER TABLE work_projects_roles ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions TYPE JSON');
        $this->addSql('ALTER TABLE work_projects_roles ALTER permissions DROP DEFAULT');
    }
}
